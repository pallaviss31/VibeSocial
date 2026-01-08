<?php

namespace App\Livewire\User\StudyGroups;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.user.study-groups.index', [
        'myGroups' => StudyGroup::where('created_by', auth()->id())->get(),
        'joinedGroups' => auth()->user()->groupMemberships,
        'publicGroups' => StudyGroup::where('visibility', 'public')->get(),
    ]);
    }
}
