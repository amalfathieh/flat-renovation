<?php

namespace App\Http\Controllers;

use App\Http\Responses\Response;
use App\Models\Objection;
use App\Models\ProjectStage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ObjectionController extends Controller
{
    public function create($stageId, Request $request)
    {
        $request->validate([
            'text' => ['required', 'string'],
        ]);

        $customerId = Auth::user()->customerProfile->id;

        $stage = ProjectStage::where('id', $stageId)->first();

        if (!$stage) {
            return Response::Error('stage not found', 404);
        }

        if ($stage->project->customer_id != $customerId) {
            return Response::Error(__('strings.authorization_required'));
        }

        $obj = Objection::create([
            'project_stage_id' => $stageId,
            'customer_id' => $customerId,
            'text' => $request->text,
        ]);

        return Response::Success($obj, __('strings.created_successfully'));
    }

    public function getObjections($stageId)
    {
        try {
            $stage = ProjectStage::where('id', $stageId)->first();
            if (!$stage) {
                return Response::Error('stage not found', 404);
            }

            $customerId = Auth::user()->customerProfile->id;
        if ($stage->project->customer_id != $customerId) {
            return Response::Error(__('strings.authorization_required'));
        }
            return Response::Success($stage->objections, 'success');

        }catch (\Exception $ex) {
            return Response::Error($ex->getMessage(), $ex->getCode() ?: 404);
        }
         }
}
