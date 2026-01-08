<?php

namespace App\Livewire\User\StudyGroups;

use App\Models\GroupMember;
use App\Models\StudyGroup;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layout.user')]
class GroupShow extends Component
{
    public StudyGroup $group;
    public $requests = [];
    public $membership = null;
    public $canView = false;

    public function mount(StudyGroup $group)
    {
        $this->group = $group->load('members.user');

        $this->membership = $this->group->members
    ->where('user_id', auth()->id())
    ->first();

        if (
            auth()->id() === $group->created_by ||
            ($this->membership && $this->membership->status === 'joined')
        ) {
            $this->canView = true;
        }

        if (auth()->id() === $group->created_by) {
            $this->requests = GroupMember::with('user')
                ->where('study_group_id', $group->id)
                ->where('status', 'requested')
                ->get();
        }
    }

    public function approve($requestId)
    {
        GroupMember::findOrFail($requestId)
            ->update(['status' => 'joined']);

        $this->requests = $this->requests->where('id', '!=', $requestId);
    }

    public function reject($requestId)
    {
        GroupMember::findOrFail($requestId)->delete();
        $this->requests = $this->requests->where('id', '!=', $requestId);
    }

    public function render()
    {
        return view('livewire.user.study-groups.group-show');
    }
}
