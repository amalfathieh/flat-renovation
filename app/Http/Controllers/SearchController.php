<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Responses\Response; // ✅ استدعاء كلاس الريسبونس

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = trim($request->input('search'));
        $companiesQuery = Company::with('services');

        // تطبيق الفلاتر إذا تم كتابة شيء في البحث
        if (!empty($search)) {
            $this->applyFilters($companiesQuery, $search);
        }

        $companies = $companiesQuery->paginate(10);

        // إن لم يتم العثور على أي شركة
        if ($companies->isEmpty()) {
            return Response::error('لا توجد نتائج مطابقة', 404);
        }

        // تعديل المسارات
        $companies->getCollection()->transform(fn($company) => $this->transformCompany($company));

        // الرد بالبيانات
        return Response::success(
            $companies,
            $search ? 'نتائج البحث' : 'كل الشركات'
        );
    }

    private function applyFilters($query, $search)
    {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%")
                ->orWhereHas('services', function ($q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
        });
    }

    private function transformCompany($company)
    {
        $company->logo = $this->imagePath($company->logo);

        $company->services->transform(function ($service) {
            $service->image = $this->imagePath($service->image);
            return $service;
        });

        return $company;
    }

    private function imagePath($path)
    {
        return $path ? asset('storage/' . ltrim($path, '/')) : null;
    }
}
