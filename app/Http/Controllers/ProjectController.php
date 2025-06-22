<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Http\Responses\Response;
use App\Models\Project;
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
}
