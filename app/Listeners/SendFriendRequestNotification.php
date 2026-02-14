<?php

namespace App\Listeners;
use App\Events\FriendRequestSent;
use App\Models\Notification;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendFriendRequestNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(FriendRequestSent $event): void
    {Notification::create([
            'user_id' => $event->toUser->id,
            'from_user_id' => $event->fromUser->id,
            'type' => 'friend_request',
            'message' => $event->fromUser->name . ' sent you a friend request',
            'link' => '/friend-requests',
        ]);
    }
}
