<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Responses\Response;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $user = Auth::user();
        $customer = $user?->customerprofile;

        $search = trim($request->input('search'));

        $companiesQuery = Company::with(['services', 'projectRatings']);

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


        $companies->getCollection()->transform(function ($company) use ($customer) {
            return [
                'id' => $company->id,
                'name' => $company->name,
                'location' => $company->location,
                'phone' => $company->phone,
                'about' => $company->about,
                'logo' => $company->logo,
                'services' => $company->services,
                'average_rating' => round($company->projectRatings->avg('rating'), 2),
                'is_favorited' => $customer
                    ? $customer->favorite->contains($company->id)
                    : false,
            ];
        });


        $message = !empty($search) ? 'نتائج البحث' : 'كل الشركات';


        return Response::success($companies->toArray(), $message);
    }

}


