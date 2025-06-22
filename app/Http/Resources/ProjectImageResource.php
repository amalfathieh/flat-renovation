<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectImageResource extends JsonResource
{
    public function toArray($request)
    {

//        dd($this->projectImages);
        return [
            'id' => $this->id,
            'before_image' => $this->projectImages->before_image,
            'after_image'=>$this->projectImages->after_image,
            'caption' => $this->caption,
        ];
    }
}
