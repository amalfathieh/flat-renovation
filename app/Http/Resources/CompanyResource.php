<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'email' => $this->email,
            'location' => $this->location,
            'phone' => $this->phone,
            'about' => $this->about,
            'logo' => $this->logo,
            'services' => ServiceResource::collection($this->whenLoaded('services')),
            'projects' => ProjectResource::collection($this->whenLoaded('projects')),
            'cost_of_examination' => $this->cost_of_examination,
        ];
    }
}
