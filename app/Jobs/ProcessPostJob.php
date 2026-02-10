<?php

namespace App\Jobs;
use App\Models\UserPost;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProcessPostJob implements ShouldQueue
{
   use Dispatchable, Queueable, SerializesModels;

    public $post;
    /**
     * Create a new job instance.
     */
    public function __construct(UserPost $post)
    {
          $this->post = $post;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
         Image::make(storage_path('app/public/' . $this->post->image))
         ->resize(800, null, function ($constraint) {
             $constraint->aspectRatio();
         })
         ->save();

    // notify followers
    foreach ($this->post->user->followers as $follower) {
        Notification::send($follower, new NewPostNotification($this->post));
    }
          \Log::info('Processing post ID: ' . $this->post->id);
    }
}
