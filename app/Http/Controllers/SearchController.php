<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Responses\Response;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = trim($request->input('search'));

        $companiesQuery = Company::with('services');

        if (!empty($search)) {
            $companiesQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhereHas('services', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                            ->orWhere('description', 'like', "%{$search}%");
                    });
            });
        }

        $companies = $companiesQuery->paginate(10);

        if ($companies->isEmpty()) {
            return Response::error('لا توجد نتائج مطابقة', 404);
        }

        $message = !empty($search) ? 'نتائج البحث' : 'كل الشركات';

        return Response::success($companies, $message);
    }
}
