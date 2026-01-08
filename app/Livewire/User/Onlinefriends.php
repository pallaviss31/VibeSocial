<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\User;

class Onlinefriends extends Component
{
    public function render()
    {
        $myFriendsIds = auth()->user()->friends()->pluck('id')->toArray();
        $users = User::whereIn('id', $myFriendsIds)->get();
        return view('livewire.user.onlinefriends',["users"=>$users]);
    }
}