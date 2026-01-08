<?php

namespace App\Livewire\User;

use Livewire\Component;

class FriendshipButton extends Component
{
    public $selectedUser;

    public $friendshipStatus;

    public function mount($selectedUser)
    {
        $this->selectedUser = $selectedUser;
        $this->determineFriendshipStatus();
    }

    public function determineFriendshipStatus()
    {
        $user = auth()->user();

        $friendRequest = \App\Models\FriendRequest::where(function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', $this->selectedUser->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('sender_id', $this->selectedUser->id)
                ->where('receiver_id', $user->id);
        })->first();

        if (! $friendRequest) {
            $this->friendshipStatus = 'not_friends';
        } elseif ($friendRequest->status === 'pending') {
            if ($friendRequest->sender_id === $user->id) {
                $this->friendshipStatus = 'request_sent';
            } else {
                $this->friendshipStatus = 'request_received';
            }
        } elseif ($friendRequest->status === 'accepted') {
            $this->friendshipStatus = 'friends';
        } else {
            $this->friendshipStatus = 'not_friends';
        }
    }

    public function sendFriendRequest()
    {
        $user = auth()->user();

        \App\Models\FriendRequest::create([
            'sender_id' => $user->id,
            'receiver_id' => $this->selectedUser->id,
            'status' => 'pending',
        ]);

        $this->determineFriendshipStatus();
    }
    public function cancelFriendRequest()
    {
        $user = auth()->user();

        \App\Models\FriendRequest::where('sender_id', $user->id)
            ->where('receiver_id', $this->selectedUser->id)
            ->delete();

        $this->determineFriendshipStatus();
    }

    public function acceptFriendRequest()
    {
        $user = auth()->user();

        $friendRequest = \App\Models\FriendRequest::where('sender_id', $this->selectedUser->id)
            ->where('receiver_id', $user->id)
            ->first();

        if ($friendRequest) {
            $friendRequest->status = 'accepted';
            $friendRequest->save();
        }

        $this->determineFriendshipStatus();
    }

    public function unfriend()
    {
        $user = auth()->user();

        \App\Models\FriendRequest::where(function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', $this->selectedUser->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('sender_id', $this->selectedUser->id)
                ->where('receiver_id', $user->id);
        })->delete();

        $this->determineFriendshipStatus();
    }
    public function rejectFriendRequest()
    {
        $user = auth()->user();

        \App\Models\FriendRequest::where('sender_id', $this->selectedUser->id)
            ->where('receiver_id', $user->id)
            ->delete();

        $this->determineFriendshipStatus();
    }
    

    public function render()
    {
        return view('livewire.user.friendship-button');
    }
}