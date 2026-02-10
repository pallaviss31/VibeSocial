<?php

namespace App\Livewire\User;

use App\Models\Story as StoryModel;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Story extends Component
{
    use WithFileUploads;

    // public $progress = 0;

    public $stories = [];

    public $viewerOpen = false;

    public $currentStories = [];

    public $currentIndex = 0;

    #[Validate('required|file|mimes:jpg,jpeg,png,mp4,mov|max:10240')]
    public $media_path;

    public function mount()
    {
        $this->loadStories();
    }

    // 🔁 Load all users stories grouped
    public function loadStories()
    {
        $this->stories = StoryModel::with('user')
            ->where('expires_at', '>', now())
            ->latest()
            ->get();
    }
     public function updatedMediaPath()
    {
        $this->createStory();
    }

    public function createStory()
    {
        $data = $this->validate();

        try {
            $path = $this->media_path->store('stories', 'public');

            StoryModel::create([
                'user_id' => auth()->id(),
                'media_path' => $path,
                'expires_at' => now()->addHours(24),
            ]);

            $this->media_path = null;

            // reload all stories
            $this->loadStories();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    // auto upload when file selected
   

   public function openStory($userId)
{
    $this->currentStories = StoryModel::where('user_id',$userId)
        ->latest()
        ->get()
        ->toArray();

    $this->currentIndex = 0;
    $this->viewerOpen = true;
}

   public function nextStory()
{
    if ($this->currentIndex < count($this->currentStories)-1) {
        $this->currentIndex++;
    } else {
        $this->viewerOpen = false;
    }
}

public function prevStory()
{
    if ($this->currentIndex > 0) {
        $this->currentIndex--;
    }
}

    // public function autoNext()
    // {
    //     if ($this->currentIndex < count($this->currentStories) - 1) {
    //         $this->currentIndex++;
    //         $this->progress = 0;
    //     } else {
    //         $this->viewerOpen = false;
    //         $this->progress = 0;
    //     }
    // }

    public function render()
    {
        return view('livewire.user.story');
    }
}
