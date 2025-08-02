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
    public function comment(Request $request, $projectId)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $project = Project::with('order.customer')->findOrFail($projectId);

        $customer = Customer::where('user_id', auth()->id())->first();

        if (!$customer) {
            return response()->json(['error' => 'الزبون غير موجود أو غير مسجل الدخول'], 403);
        }

        if ($project->order->customer_id !== $customer->id) {
            return response()->json(['error' => 'غير مصرح لك بالتعليق على هذا المشروع'], 403);
        }

        $review = ProjectRating::firstOrNew([
            'project_id' => $project->id,
            'customer_id' => $customer->id,
        ]);

        $review->comment = $validated['comment'];
        $review->save();

        return response()->json([
            'message' => 'تم حفظ التعليق بنجاح',
            'review' => $review,
        ]);
    }

    public function rate(Request $request, $projectId)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $project = Project::with('order.customer')->findOrFail($projectId);

        $customer = Customer::where('user_id', auth()->id())->first();

        if (!$customer) {
            return response()->json(['error' => 'الزبون غير موجود أو غير مسجل الدخول'], 403);
        }

        if ($project->order->customer_id !== $customer->id) {
            return response()->json(['error' => 'غير مصرح لك بتقييم هذا المشروع'], 403);
        }

        $review = ProjectRating::firstOrNew([
            'project_id' => $project->id,
            'customer_id' => $customer->id,
        ]);

        $review->rating = $validated['rating'];
        $review->save();

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


}
