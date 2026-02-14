<?php

namespace App\Livewire\User;

use App\Models\Notification;
use Livewire\Component;

class NotificationBell extends Component
{
    public $count = 0;
    public $notifications = [];
    public $open = false;
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
     public function toggleDropdown()
    {
        $this->open = !$this->open;

        if ($this->open) {
            $this->loadNotifications();
        }
    }

    public function markAsRead($id)
    {
        Notification::where('id', $id)
            ->where('user_id', auth()->id())
            ->update(['is_read' => true]);

        $this->loadNotifications();
    }

   public function markAllRead()
    {
        Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $this->loadNotifications();
    }

    protected $listeners = ['notificationReceived' => 'loadNotifications'];

    public function render()
    {
        return view('livewire.user.notification-bell');
    }
}
