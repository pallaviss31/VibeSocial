<?php

namespace App\Livewire\User;

use App\Models\Notification;
use Livewire\Component;

class NotificationBell extends Component
{
    public $count = 0;
    public $notifications = [];

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        $this->count = Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->count();

        $this->notifications = Notification::where('user_id', auth()->id())
            ->latest()
            ->take(10)
            ->get();
    }

    public function markAsRead($id)
    {
        Notification::find($id)?->update(['is_read' => true]);
        $this->loadNotifications();
    }

    protected $listeners = ['notificationReceived' => 'loadNotifications'];

    public function render()
    {
        return view('livewire.user.notification-bell');
    }
}
