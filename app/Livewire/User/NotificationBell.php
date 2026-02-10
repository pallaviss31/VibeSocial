<?php

namespace App\Livewire\User;
use App\Models\Notification;

use Livewire\Component;

class NotificationBell extends Component
{
     public $count = 0;

    public function mount()
    {
        $this->loadCount();
    }

    public function loadCount()
    {
        $this->count = Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->count();
    }

    protected $listeners = ['notificationAdded' => 'loadCount'];

    public function render()
    {
        return view('livewire.user.notification-bell');
    }
}
