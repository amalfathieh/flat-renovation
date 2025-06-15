<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Http\Responses\Response;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('services')->get();

        return Response::Success($companies, 'تم جلب قائمة الشركات');
    }

    public function show(Company $company)
    {
        $projects = $company->projects()->with('projectImages')->get();

        return Response::Success($projects, 'تم جلب مشاريع الشركة');
    }
}
