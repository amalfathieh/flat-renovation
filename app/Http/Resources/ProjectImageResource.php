<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectImageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image_url' => $this->image,
            'type' => $this->type,
            'caption' => $this->caption,
        ];
    }
}
