<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Http\Responses\Response;
use App\Models\Customer;
use App\Models\Project;
use App\Models\ProjectRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    public function getMyProjects(){

        $customer_name =  Auth::user()->name;

        $projects = Project::with('company')->where('customer_name', $customer_name)->get();

        return Response::Success(ProjectResource::collection($projects), 'success');

    }

    public function getAllPublishProjects(){

        $projects = Project::with('company')->where('is_publish', true)->get();

        return Response::Success(ProjectResource::collection($projects), 'success');

    }
    public function store(Request $request, $projectId)
    {
        $validated = $request->validate([
            'rating' => 'nullable|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);



        $project = Project::with('order.customer')->findOrFail($projectId);


        $customer = Customer::where('user_id', auth()->id())->first();

        if (!$customer) {
            return response()->json(['error' => 'الزبون غير موجود أو غير مسجل الدخول'], 403);
        }


        if ($project->order->customer_id !== $customer->id) {
            return response()->json(['error' => 'غير مصرح لك بتقييم هذا المشروع'], 403);
        }


        $existingReview = ProjectRating::where('project_id', $project->id)
            ->where('customer_id', $customer->id)
            ->first();

        if ($existingReview) {
            return response()->json(['error' => 'تم تقييم المشروع مسبقًا'], 400);
        }


        $review = ProjectRating::create([
            'project_id' => $project->id,
            'customer_id' => $customer->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment']
        ]);

        return response()->json([
            'message' => 'تم حفظ التقييم بنجاح',
            'review' => $review,
        ]);
    }
    public function showUserReview($projectId)
    {

        $customer = Customer::where('user_id', auth()->id())->first();

        if (!$customer) {
            return response()->json(['message' => 'الزبون غير موجود أو غير مسجل الدخول'], 403);
        }


        $review = ProjectRating::where('project_id', $projectId)
            ->where('customer_id', $customer->id)
            ->first();

        if (!$review) {
            return response()->json(['message' => 'لا يوجد تقييم لهذا المشروع من هذا المستخدم'], 404);
        }

        return response()->json([
            'message' => 'تم جلب التقييم بنجاح',
            'review' => $review,
        ]);
    }

    public function projectHistory($projectId)
    {
        $user = auth()->user();

        $project = Project::with([
            'projectStages.imagesStage',
            'projectStages.objections',
            'ratings',
            'company',
        ])
            ->where('customer_id', $user->id)
            ->findOrFail($projectId);

        return response()->json($project);
    }

//    public function getProjectTimeline(Request $request, $projectId)
//    {
//        $statusFilter = $request->query('status'); // ممكن يكون: finished, In progress, Preparing
//
//
//        $project = Project::with(['projectStages.imagesStage'])->find($projectId);
//
//        if (!$project) {
//            return Response::Error('المشروع غير موجود', 404);
//        }
//
//
//        $stages = $project->projectStages
//            ->when($statusFilter, function ($stages, $statusFilter) {
//                return $stages->where('status', $statusFilter);
//            })
//            ->sortBy('started_at')
//            ->values();
//
//
//        $timeline = $stages->map(function ($stage) {
//            return [
//                'id' => $stage->id,
//                'stage_name' => $stage->stage_name,
//                'description' => $stage->description,
//                'status' => $stage->status,
//                'is_confirmed' => $stage->is_confirmed,
//                'started_at' => optional($stage->started_at)->toDateString(),
//                'completed_at' => optional($stage->completed_at)->toDateString(),
//                'cost' => $stage->cost,
//                'images' => $stage->imagesStage->map(function ($image) {
//                    return [
//                        'url' => $image->image,
//                        'description' => $image->description,
//                        'date' => $image->stage_date,
//                    ];
//                }),
//            ];
//        });
//
//        return Response::Success($timeline, 'تم جلب مراحل المشروع بنجاح');
//    }
}
