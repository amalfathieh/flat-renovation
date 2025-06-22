<?php

namespace App\Http\Controllers;

use App\Http\Responses\Response;
use App\Models\ProjectStage;
use App\Models\Service;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectStageController extends Controller
{
    public function getProjectStages($id){

        $projectStages = ProjectStage::where('project_id', $id)->get();

        return Response::Success($projectStages, 'success');
    }

    public function getServiceTypes($id){
        $service = Service::find($id)->first();
        if(!$service){
            return Response::Error('error service');
        }
        return Response::Success($service->serviceTypes, 'success');
    }

    public function editServiceType($id, Request $request){
        $request->validate([
            'service_type_id' => ['required', 'int'],
        ]);
        $stage = ProjectStage::where('id', $id)->first();

        if(!$stage){
            return Response::Error('not found', 404);
        }
        if($stage->project->customer_id != Auth::id()){
            return Response::Error(__('strings.authorization_required'));
        }

        $serviceType = ServiceType::where('id', $request->service_type_id)->first();

        if (!$serviceType){
            return Response::Error('error type');
        }
        $stage->service_type_id = $serviceType->id;
        $stage->save();

        return Response::Success($stage, __('strings.updated_successfully'));
    }
}
