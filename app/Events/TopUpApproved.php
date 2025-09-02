<?php

namespace App\Events;

use App\Models\TopUpRequest;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TopUpApproved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public TopUpRequest $request;

    public function __construct(TopUpRequest $request)
    {
        $this->request = $request;
    }


}
