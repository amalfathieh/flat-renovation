<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ConfirmCompanySubscription
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $plan;
    public $company;
    /**
     * Create a new event instance.
     */
    public function __construct($user, $company, $plan)
    {
        $this->user = $user;
        $this->company = $company;
        $this->plan = $plan;

    }

}
