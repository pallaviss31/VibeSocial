<?php

namespace App\Livewire\User\StudyGroups;

use App\Models\GroupMember;
use App\Models\StudyGroup;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layout.user')]
class Create extends Component
{
    use WithFileUploads;

    public $name,
        $description,
        $subject,
        $visibility = 'public',
        $cover_image;

    public function save()
{
    $this->validate([
        'name' => 'required|string|min:3',
        'description' => 'nullable|string|min:5',
        'subject' => 'nullable|string',
        'visibility' => 'required|in:public,private',
        'cover_image' => 'nullable|image|max:2048',
    ]);

    $slug = Str::slug($this->name) . '-' . time();

    $group = StudyGroup::create([
        'name' => $this->name,
        'slug' => $slug,
        'description' => $this->description,
        'subject' => $this->subject,
        'visibility' => $this->visibility,
        'created_by' => auth()->id(),
        'cover_image' => $this->cover_image
            ? $this->cover_image->store('group_covers', 'public')
            : null,
    ]);

    GroupMember::create([
        'study_group_id' => $group->id,
        'user_id' => auth()->id(),
        'role' => 'admin',
        'status' => 'joined',
        'joined_at' => now(),
    ]);

    session()->flash('success', 'Group created successfully!');
    return redirect()->route('grouplist');
}

    public function render()
    
    {
        return view('livewire.user.study-groups.create');
    }
}
