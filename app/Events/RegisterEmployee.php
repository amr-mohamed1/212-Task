<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegisterEmployee
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $employee;

    public function __construct($emp)
    {
        $this->employee = $emp;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
