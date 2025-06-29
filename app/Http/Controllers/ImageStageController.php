<?php

namespace App\Http\Controllers;

use App\Models\Image_stage;
use Illuminate\Http\Request;

class ImageStageController extends Controller
{

    public function images($stageId)
    {
        $images = Image_stage::where('project_stage_id', $stageId)
            ->select('id', 'image', 'description', 'stage_date')
            ->get();

        return response()->json($images);
    }

}
