<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Http\Resources\ProjectResource;
use App\Models\Company;
use App\Http\Responses\Response;
use App\Models\Project;


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


    public function getCompanyPublishProjects($id){

//        return "g";
        $projects = Project::with('company')->where('is_publish', true)
            ->where('company_id', $id)->get();

        return Response::Success(ProjectResource::collection($projects), 'success');

    }


}
