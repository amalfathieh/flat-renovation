<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class ProjectResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'company_id' => $this->company->id,
            'company_name' => $this->company->name,
            'employee_name' => $this->employee->first_name. ' ' . $this->employee->last_name,
            'project_name' => $this->project_name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
            'description' => $this->description,
            'rating' => round($this->averageRating(), 1),
            'images' => ProjectImageResource::collection($this->projectImages),
        ];
    }
}
