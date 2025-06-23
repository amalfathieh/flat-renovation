<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'project_id' => $this->project_id,
            'stage_name' => $this->stage_name,
            'service_id' => $this->service_id,
            'service_name' => $this->service->name,
            'service_type_id' => $this->serviceType->id,
            'service_type_name' => $this->serviceType->name,
            'description' => $this->description,
            'started_at' => $this->started_at,
            'completed_at' => $this->completed_at,
            'status' => $this->status,
            'cost' => $this->cost,
            'is_confirmed' => $this->is_confirmed,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'image_stage' => $this->ImageStage,
        ];
    }
}
