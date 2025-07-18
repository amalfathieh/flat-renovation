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
        $companies = Company::with('services', 'projectRatings')->get();

        $data = $companies->map(function ($company) {
            return [
                'id' => $company->id,
                'name' => $company->name,
                'location' => $company->location,
                'phone' => $company->phone,
                'about' => $company->about,
                'logo' => $company->logo,
                'services' => $company->services,
                'average_rating' => round($company->projectRatings->avg('rating'), 2), // متوسط تقييم المشاريع
            ];
        });

        return Response::Success($data, 'تم جلب قائمة الشركات مع التقييمات');
    }


    public function show(Company $company)
    {
        $projects = $company->projects()
            ->where('is_publish', true)
            ->with(['projectImages', 'ratings']) // جلب صور المشروع والتقييم
            ->get()
            ->map(function ($project) {
                return [
                    'id' => $project->id,
                    'project_name' => $project->project_name,
                    'status' => $project->status,
                    'final_cost' => $project->final_cost,
                    'start_date' => $project->start_date,
                    'end_date' => $project->end_date,
                    'images' => $project->projectImages,
                    'customer_rating' => optional($project->rating)->rating,
                    'customer_comment' => optional($project->rating)->comment,
                ];
            });

        return Response::Success($projects, 'تم جلب مشاريع الشركة مع التقييم');
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
