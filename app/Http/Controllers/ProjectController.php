<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Http\Responses\Response;
use App\Models\Project;
use App\Models\ProjectRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    public function getMyProjects(){
        $customerId =  Auth::user()->customerProfile->id;

        $projects = Project::with('company')->where('customer_id', $customerId)->get();

        return Response::Success(ProjectResource::collection($projects), 'success');

    }

    public function getAllPublishProjects(){

        $projects = Project::with('company')->where('is_publish', true)->get();

        return Response::Success(ProjectResource::collection($projects), 'success');

    }
    public function store(Request $request, $projectId)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $project = Project::findOrFail($projectId);
        $customerId = auth()->id();


        if ($project->customer_id !== $customerId) {
            return response()->json(['error' => 'غير مصرح لك بتقييم هذا المشروع'], 403);
        }


        if ($project->ratings) {
            return response()->json(['error' => 'تم تقييم المشروع مسبقًا'], 400);
        }

        $review = ProjectRating::create([
            'project_id' => $project->id,
            'customer_id' => $customerId,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);

        return response()->json([
            'message' => 'تم حفظ التقييم بنجاح',
            'review' => $review,
        ]);
    }
    public function projectLog($projectId)
    {
        $project = Project::with([
            'stages.notes.employee',
            'stages.images',
            'payments'
        ])->where('user_id', auth()->id())->findOrFail($projectId);

        return response()->json($project);
    }


}
