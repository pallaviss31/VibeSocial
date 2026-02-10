<?php

namespace App\Livewire\User\Post;

use App\Jobs\ProcessPostJob;
use App\Models\UserPost;
use App\Services\ImageKitService;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateForm extends Component
{
    use withfileuploads;

    #[Validate('required|string|max:1000')]
    public $content;

    #[Validate('nullable|image|max:2048')]
    public $image;

    public function createPost()
    {
        $data = $this->validate();

        $data['user_id'] = auth()->id();

        // 👉 Upload image to ImageKit
        if ($this->image) {
            $service = new ImageKitService();

            $url = $service->upload(
                base64_encode(file_get_contents($this->image->getRealPath())),
                '/posts'
            );

            $data['image'] = $url;  // save URL in DB
        }

        $post = UserPost::create($data);

        ProcessPostJob::dispatch($post);

        $this->reset('content', 'image');
        $this->dispatch('postCreated');

        session()->flash('message', 'Post created successfully!');
    }

    public function render()
    {
        return view('livewire.user.post.create-form');
    }
}
