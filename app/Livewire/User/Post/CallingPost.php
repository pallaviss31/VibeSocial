<?php

namespace App\Livewire\User\Post;

use App\Events\PostLiked;
use App\Events\CommentAdded;
use App\Events\FriendRequestSent;
use App\Models\UserPost;
use Livewire\Attributes\On;
use Livewire\Component;

class CallingPost extends Component
{
    public $posts;
    public $comments = [];

    public function mount($selectedUser = null)
    {
        $this->loadPosts($selectedUser);
    }

    public function loadPosts($selectedUser = null)
    {
        if ($selectedUser && $selectedUser->id != auth()->user()->id) {
            $this->posts = UserPost::where('user_id', $selectedUser->id)
                ->latest()
                ->get();
        } else {
            $myFriendsIds = auth()->user()->friends()->pluck('id')->toArray();

            $this->posts = UserPost::whereIn('user_id', $myFriendsIds)
                ->orWhere('user_id', auth()->id())
                ->latest()
                ->get();
        }
    }

    #[On('postCreated')]
    public function refreshPosts()
    {
        $this->loadPosts();
    }

    public function test()
    {
        dd('WORKING');
    }

    public function like($postId)
    {
        // dd('clicked');
        $post = UserPost::find($postId);
        if (!$post)
            return;

        // already liked → unlike
        if ($post->likes()->where('user_id', auth()->id())->exists()) {
            $post->likes()->where('user_id', auth()->id())->delete();
            $this->dispatch('postCreated');
            return;
        }

        // like
        $post->likes()->create([
            'user_id' => auth()->id()
        ]);

        //  EVENT FIRE
        event(new PostLiked($post, auth()->user()));

        $this->dispatch('postCreated');
    }

    public function addComment($postId)
    {
       $post = UserPost::find($postId);
    if (!$post) return;

    $text = $this->comments[$postId] ?? null;

    if (!$text) return;

    $post->comments()->create([
        'user_id' => auth()->id(),
        'comment' => $text
    ]);

    event(new \App\Events\CommentAdded($post, auth()->user()));

    // reset only this input
    $this->comments[$postId] = '';

    $this->dispatch('postCreated');
    }

    public function render()
    {
        return view('livewire.user.post.calling-post', ['posts' => $this->posts]);
    }
}
