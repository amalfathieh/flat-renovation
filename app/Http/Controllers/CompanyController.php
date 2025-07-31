<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Company;
use App\Http\Responses\Response;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $customer = $user?->customerprofile;

        $companies = Company::with('services', 'projectRatings')->get();

        $data = $companies->map(function ($company) use ($customer) {
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

        return Response::Success($data, 'تم جلب قائمة الشركات مع التقييمات');
    }


    public function show(Company $company)
    {
        $user = Auth::user();
        $customer = $user?->customerprofile;

        $projects = $company->projects()
            ->where('is_publish', true)
            ->with(['projectImages', 'ratings'])
            ->get()
            ->map(function ($project) {
                return [
                    'id' => $project->id,
                    'project_name' => $project->project_name,
                    'status' => $project->status,
                    'final_cost' => $project->final_cost,
                    'description' => $project->description,
                    'start_date' => $project->start_date,
                    'end_date' => $project->end_date,
                    'images' => $project->projectImages,
                    'customer_rating' => optional($project->ratings)->rating,
                    'customer_comment' => optional($project->ratings)->comment,
                ];
            });

        $companyInfo = [
            'id' => $company->id,
            'name' => $company->name,
            'about' => $company->about,
            'location' => $company->location,
            'logo' => $company->logo,
            'is_favorited' => $customer
                ? $customer->favorite->contains($company->id)
                : false,
            'projects' => $projects,
        ];

        return Response::Success($companyInfo, 'تفاصيل الشركة والمشاريع');
    }
//    public function getCompanyPublishProjects($id)
//    {
//
//        //        return "g";
//        $projects = Project::with('company')->where('is_publish', true)
//            ->where('company_id', $id)->get();
//
//        return Response::Success(ProjectResource::collection($projects), 'success');
//    }
}
