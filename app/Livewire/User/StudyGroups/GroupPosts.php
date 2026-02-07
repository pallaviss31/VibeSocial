<?php

namespace App\Livewire\User\StudyGroups;

use App\Models\GroupPost;
use App\Models\StudyGroup;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layout.user')]
class GroupPosts extends Component
{
    use WithFileUploads;

    public $editingPostId = null;
    public $editContent = '';
    public StudyGroup $group;
    public $content;
    public $image;
    public $posts = [];

    public function mount(StudyGroup $group)
    {
        $this->group = $group;

        $this->loadPosts();  // Move logic to a dedicated function
    }

    public function loadPosts()
    {
        $this->posts = GroupPost::with('user')
            ->where('study_group_id', $this->group->id)
            ->latest()
            ->get();
    }

    public function isAdmin()
    {
        return auth()->id() === $this->group->created_by;
    }

    public function isOwner($post)
    {
        return auth()->id() === $post->user_id;
    }

    public function canEdit($post)
    {
        return $this->isAdmin() || $this->isOwner($post);
    }

    public function canPost()
    {
        return $this
            ->group
            ->members()
            ->where('user_id', auth()->id())
            ->where('status', 'joined')
            ->exists() ||
            $this->isAdmin();
    }

    /* ---------------- CREATE POST ---------------- */

    public function createPost()
    {
        if (!$this->canPost())
            return;

        $this->validate([
            'content' => 'nullable|string|max:1000',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $this->image
            ? $this->image->store('group-posts', 'public')
            : null;

        $post = GroupPost::create([
            'study_group_id' => $this->group->id,
            'user_id' => auth()->id(),
            'content' => $this->content,
            'image' => $imagePath,
        ]);
        $this->posts->prepend($post->load('user'));

        $this->reset(['content', 'image']);
    }

    /* ---------------- DELETE ---------------- */

    public function deletePost($postId)
    {
        $post = GroupPost::findOrFail($postId);

        if (!$this->canEdit($post))
            abort(403);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        $this->posts = $this->posts->where('id', '!=', $postId);
    }

    public function render()
    {
        return view('livewire.user.study-groups.group-posts');
    }
}
