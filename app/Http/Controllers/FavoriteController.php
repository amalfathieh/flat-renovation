<?php

namespace App\Http\Controllers;

use App\Http\Responses\Response;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function toggleFavorite($companyId)
    {
        $user = Auth::user();
        $customer = $user->customerProfile;

        if (!$customer) {
            return Response::Error('ليس لديك حساب زبون', 403);
        }

        $company = Company::findOrFail($companyId);

        if ($customer->favorite()->where('company_id', $companyId)->exists()) {
            $customer->favorite()->detach($companyId);
            return Response::Success(null, 'تمت إزالة الشركة من المفضلة');
        } else {
            $customer->favorite()->attach($companyId);
            return Response::Success(null, 'تمت إضافة الشركة إلى المفضلة');
        }
    }

    public function listFavorites()
    {
        $user = Auth::user();
        $customer = $user->customerProfile;

        if (!$customer) {
            return Response::Error('ليس لديك حساب زبون', 403);
        }

        $favorites = $customer->favorite()->with('owner')->get();

        return Response::Success($favorites, 'تم جلب الشركات المفضلة بنجاح');
    }
}
