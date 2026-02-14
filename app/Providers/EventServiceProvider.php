<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\PostLiked::class => [
            \App\Listeners\SendLikeNotification::class,
        ],
        \App\Events\CommentAdded::class => [
            \App\Listeners\SendCommentNotification::class,
        ],
        \App\Events\FriendRequestSent::class => [
            \App\Listeners\SendFriendRequestNotification::class,
        ],
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
