<?php

namespace App\Events;
use App\Models\User;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FriendRequestSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
 public $fromUser;
    public $toUser;
    /**
     * Create a new event instance.
     */
    public function __construct(User $fromUser, User $toUser)
    {
         $this->fromUser = $fromUser;
        $this->toUser = $toUser;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
