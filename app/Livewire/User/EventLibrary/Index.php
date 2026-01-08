<?php

namespace App\Livewire\User\EventLibrary;

use App\Models\EventPlace;
use App\Models\EventUser;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layout.user')]
class Index extends Component
{
    public $search = '';
    public $isCreating = false;
    public $filter = 'all';
    // Optionally track join-requests if you want to flash a message etc.
    public $message = '';

    public function setFilter($value)
    {
        $this->filter = $value;
    }

    public function toggleCreate()
    {
        $this->isCreating = !$this->isCreating;
    }

    // Determine status based on date
    public function getStatus($event)
    {
        $today = now()->toDateString();

        if ($event->date == $today) {
            return 'Today';
        }
        if ($event->date > $today) {
            return 'Upcoming';
        }
        return 'Expired';
    }

    // USER action: request to join event
    public function joinEvent($eventId)
    {
        $userId = auth()->id();
        if (!$userId) {
            session()->flash('error', 'Please login first.');
            return;
        }

        $event = EventPlace::find($eventId);
        if (!$event) {
            session()->flash('error', 'Event not found');
            return;
        }

        // Prevent organizer joining their own event
        if ($event->organizer_id === $userId) {
            session()->flash('error', 'You cannot join your own event.');
            return;
        }

        // Prevent duplicate request / join
        $existing = EventUser::where('eventplace_id', $eventId)
            ->where('user_id', $userId)
            ->first();

        if ($existing) {
            session()->flash('error', 'You already joined or requested this event.');
            return;
        }

        EventUser::create([
            'eventplace_id' => $eventId,
            'user_id' => $userId,
            'participation_type' => $event->event_type === 'online' ? 'online' : 'offline',
            'status' => 'pending',
        ]);

        session()->flash('success', 'Join request sent.');
    }

   public function approveRequest($requestId = null)
{
    if (!$requestId) return;

    $request = EventUser::find($requestId);
    if (!$request) return;

    if ($request->event->organizer_id !== auth()->id()) return;

    $request->update(['status' => 'approved']);

    // 🔄 force UI refresh
    $this->dispatch('$refresh');
}

public function rejectRequest($requestId = null)
{
    if (!$requestId) return;

    $request = EventUser::find($requestId);
    if (!$request) return;

    if ($request->event->organizer_id !== auth()->id()) return;

    $request->update(['status' => 'rejected']);

    // 🔄 force UI refresh
    $this->dispatch('$refresh');
}

    public function render()
    {
        $query = EventPlace::with([
        'organizer',

        // ONLY pending join requests
        'joinRequests' => function ($q) {
            $q->where('status', 'pending')->with('user');
        },

        // logged-in user's participation
        'participants' => function ($q) {
            $q->where('user_id', auth()->id());
        }
    ]);

    if ($this->search) {
        $query->where('title', 'like', '%' . $this->search . '%');
    }

    if ($this->filter === 'today') {
        $query->whereDate('date', today());
    } elseif ($this->filter === 'upcoming') {
        $query->whereDate('date', '>', today());
    } elseif ($this->filter === 'past') {
        $query->whereDate('date', '<', today());
    }
        return view('livewire.user.event-library.index', [
            'events' => $query->orderBy('date')->get(),
        ]);
    }
}
