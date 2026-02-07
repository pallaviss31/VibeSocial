<?php

namespace App\Livewire\User\StudyGroups;
use App\Models\StudyGroup;
use App\Models\User;
use App\Models\GroupMember;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Livewire\Component;

class GroupMembers extends Component

{
    use AuthorizesRequests;

    public StudyGroup $group;

    public function makeAdmin(int $userId)
    {
        $target = User::findOrFail($userId);

        $this->authorize('makeAdmin', [$this->group, $target]);

        GroupMember::where('study_group_id', $this->group->id)
            ->where('user_id', $userId)
            ->update(['role' => 'admin']);
    }
    public function removeAdmin(int $userId)
{
    $target = User::findOrFail($userId);

    $this->authorize('removeAdmin', [$this->group, $target]);

    GroupMember::where('study_group_id', $this->group->id)
        ->where('user_id', $userId)
        ->update(['role' => 'member']);
}

public function removeMember(int $userId)
{
    $target = User::findOrFail($userId);

    $this->authorize('manageMembers', [$this->group, $target]);

    GroupMember::where('study_group_id', $this->group->id)
        ->where('user_id', $userId)
        ->delete();
}

    public function render()
    {
        return view('livewire.user.study-groups.group-members');
    }
}
