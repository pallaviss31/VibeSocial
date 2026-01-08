<?php

namespace App\Livewire\User\StudyGroups;

use Livewire\Component;
use App\Models\StudyGroup;
use App\Models\GroupMember;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout("components.layout.user")]

class ListGroups extends Component
{
       public $search = '';
    public $subjectFilter = '';
    public $visibilityFilter = '';

    public function joinRequest($groupId)
    {
        $group = StudyGroup::findOrFail($groupId);

        // Prevent duplicate request
        $exists = GroupMember::where('study_group_id', $groupId)
            ->where('user_id', auth()->id())
            ->first();

        if ($exists) return;

        GroupMember::create([
            'study_group_id' => $groupId,
            'user_id' => auth()->id(),
            'role' => 'member',
            'status' => $group->visibility === 'public'
                ? 'joined'
                : 'requested',
        ]);
    }

    public function render()
    {
        $groups = StudyGroup::query()
            ->withCount([
                'members as members_count' => function ($q) {
                    $q->where('status', 'joined');
                }
            ])
            ->where('name', 'like', '%' . $this->search . '%')

            ->when($this->subjectFilter, function ($q) {
                $q->where('subject', $this->subjectFilter);
            })

            ->when($this->visibilityFilter, function ($q) {
                $q->where('visibility', $this->visibilityFilter);
            })

            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('livewire.user.study-groups.list-groups' , compact('groups'));
    }
}
