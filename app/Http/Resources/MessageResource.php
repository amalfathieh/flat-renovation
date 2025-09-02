<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    public function toArray($request)
    {
        // نحدد الصورة حسب نوع المرسل
        $image = null;

        if ($this->sender && method_exists($this->sender, 'customerProfile') && $this->sender->customerProfile) {
            // إذا المرسل عنده بروفايل زبون
            $image = $this->sender->customerProfile->image;

        }

        if ($this->sender && method_exists($this->sender, 'company') && $this->sender->company) {
            // إذا المرسل شركة
            $image = $this->sender->company->logo;

        }

        return [
            'id'             => $this->id,
            'conversation_id'=> $this->conversation_id,
            'message'        => $this->message,
            'created_at'     => $this->created_at->toDateTimeString(),

            'sender' => [
                'id'    => $this->sender->id ?? null,
                'name'  => $this->sender->full_name ?? $this->sender->email ?? null,
                'email' => $this->sender->email ?? null,
                'image' => $image,
            ],
        ];
    }
}
