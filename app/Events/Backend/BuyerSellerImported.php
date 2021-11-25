<?php

namespace App\Events\Backend;
use App\Models\Auth\User;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BuyerSellerImported
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user, $email_details;


    public function __construct(User $user, $email_content)
    {
        $this->user = $user;   
        $this->email_details = $email_content;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
