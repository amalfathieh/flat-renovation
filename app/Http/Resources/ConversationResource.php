<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'       => $this->id,
            'customer' => [
                'id'    => $this->customer->id,
                'name'  => $this->customer->user->name,
                'email' => $this->customer->user->email,
                'image' => $this->customer->image,
            ],
            'employee' => [
                'id'    => $this->employee->id,
                'name'  => $this->employee->first_name . ' ' . $this->employee->last_name,
                'email' => $this->employee->user->email,
                'phone' => $this->employee->phone,
            ],
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
