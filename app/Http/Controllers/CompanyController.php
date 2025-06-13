<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        // جلب الشركات مع الخدمات والمشاريع وصور المشاريع دفعة واحدة
        $companies = Company::with(['services', 'projects.images'])->get();

        return CompanyResource::collection($companies);
    }
}
