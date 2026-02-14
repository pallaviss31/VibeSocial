<?php

namespace App\Listeners;
use App\Events\CommentAdded;
use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCommentNotification
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
    public function handle(CommentAdded $event): void
    {
          $post = $event->post;
        $user = $event->user;

        if ($post->user_id == $user->id) return;

        Notification::create([
            'user_id' => $post->user_id,
            'from_user_id' => $user->id,
            'type' => 'comment',
            'message' => $user->name . ' commented on your post',
            'link' => '/post/' . $post->id,
        ]);
    }
}
