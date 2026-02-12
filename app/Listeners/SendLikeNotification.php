<?php

namespace App\Listeners;

use App\Events\PostLiked;
use App\Models\Notification;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendLikeNotification
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
    public function handle(PostLiked $event): void
    {
         $post = $event->post;
        $user = $event->user;

        // agar khud ki post like ki → ignore
        if ($post->user_id == $user->id) {
            return;
        }

        Notification::create([
            'user_id' => $post->user_id,
            'from_user_id' => $user->id,
            'type' => 'like',
            'message' => $user->name . ' liked your post',
            'link' => '/post/' . $post->id,
        ]);
        // broadcast(new \App\Events\NewNotification($post->user_id));
    }
}
