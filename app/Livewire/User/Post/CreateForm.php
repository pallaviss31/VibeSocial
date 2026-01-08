<?php

namespace App\Livewire\User\Post;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\UserPost;
use Livewire\WithFileUploads;


class CreateForm extends Component
{

    use withfileuploads;

    #[Validate("required|string|max:1000")]
    public $content;

    #[Validate("nullable|image|max:2048")]
    public $image;

    public function createPost()
    {
        $data = $this->validate();

        // add user_id
        $data['user_id'] = auth()->id();

        // handle image upload
        if ($this->image) {
            $data['image'] = $this->image->store('posts', 'public');
        }

        UserPost::create($data);
        $this->reset('content', 'image');
        $this->dispatch("postCreated");
        session()->flash('message', 'Post created successfully!');
    }

    public function render()
    {
        return view('livewire.user.post.create-form');
    }
}