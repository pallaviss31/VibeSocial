<?php

namespace App\Livewire\User\StudyGroups;

use Livewire\Component;
use App\Models\StudyGroup;
use App\Models\GroupMember;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout("components.layout.user")]

class ManageRequests extends Component
{
    public function approve($memberId)
{
    GroupMember::where('id', $memberId)
        ->update([
            'status' => 'joined',
            'joined_at' => now()
        ]);
}

public function reject($memberId)
{
    GroupMember::where('id', $memberId)->delete();
}
    public function render()
    {
          $requests = GroupMember::where('study_group_id', $this->groupId)
                            ->where('status', 'requested')
                            ->get();
        return view('livewire.user.study-groups.manage-requests', compact('requests'));
    }
}
