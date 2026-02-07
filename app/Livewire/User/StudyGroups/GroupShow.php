<?php

namespace App\Livewire\User\StudyGroups;

use App\Models\GroupMember;
use App\Models\StudyGroup;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

#[Layout('components.layout.user')]
class GroupShow extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;

    public StudyGroup $group;
    public string $activeTab = 'dashboard';
    public $members = [];
    public $requests = [];
    public $membership = null;

    public bool $canView = false;
    public bool $isAdmin = false;
    public $cover;

    public function mount(StudyGroup $group)
    {
        $this->group = $group;

        // 🔑 Default tab
        $this->activeTab = 'dashboard';

        // Membership info
        $this->membership = GroupMember::where('study_group_id', $group->id)
            ->where('user_id', auth()->id())
            ->first();

        // Can view group?
        if (
            auth()->id() === $group->created_by ||
            ($this->membership && $this->membership->status === 'joined')
        ) {
            $this->canView = true;
        }

        // Is admin?
        $this->isAdmin =
            auth()->id() === $group->created_by ||
            ($this->membership && $this->membership->role === 'admin');

        // Load pending requests for admins
        if ($this->isAdmin) {
            $this->requests = GroupMember::with('user')
                ->where('study_group_id', $group->id)
                ->where('status', 'requested')
                ->get();
        }
    }

    // Switch tabs
    public function setTab(string $tab)
    {
        $this->activeTab = $tab;

        if ($tab === 'members') {
            $this->loadMembers();
        }
    }

    // Load members when needed
    public function loadMembers()
    {
        $this->members = GroupMember::with('user')
            ->where('study_group_id', $this->group->id)
            ->where('status', 'joined')
            ->get();
    }

    // Cover update
    public function updateCover()
    {
        if (!$this->isAdmin) abort(403);

        $this->validate([
            'cover' => 'image|max:2048',
        ]);

        $path = $this->cover->store('group-covers', 'public');

        $this->group->update([
            'cover_image' => $path,
        ]);

        session()->flash('success', 'Group cover updated!');
    }

    // Approve join request
    public function approve($id)
    {
        GroupMember::findOrFail($id)->update(['status' => 'joined']);
        $this->requests = $this->requests->where('id', '!=', $id);
    }

    // Reject join request
    public function reject($id)
    {
        GroupMember::findOrFail($id)->delete();
        $this->requests = $this->requests->where('id', '!=', $id);
    }

    public function render()
    {
        return view('livewire.user.study-groups.group-show');
    }
}
