<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Http\Responses\Response;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('services')->get();

        // تعديل الصور لمسار كامل
//        $companies->transform(function ($company) {
//            if ($company->logo) {
//                $company->logo = $this->fullImagePath($company->logo);
//            }
//
//            // تعديل صور الخدمات
//            if ($company->services) {
//                $company->services->transform(function ($service) {
//                    if ($service->image) {
//                        $service->image = $this->fullImagePath($service->image);
//                    }
//                    return $service;
//                });
//            }
//
//            return $company;
//        });

        return Response::Success($companies, 'تم جلب قائمة الشركات');
    }

    public function show(Company $company)
    {
        $projects = $company->projects()->with('projectImages')->get();


        return Response::Success($projects, 'تم جلب مشاريع الشركة');
    }


}
