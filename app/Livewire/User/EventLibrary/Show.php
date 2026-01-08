<?php

namespace App\Livewire\User\EventLibrary;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\EventPlace;
use App\Models\EventUser;

#[Layout('components.layout.user')]

class Show extends Component
{
     public EventPlace $event;
    public bool $openJoin = false;
    public string $participation_type = 'online';

    public function mount($id)
    {
        $this->event = EventPlace::findOrFail($id);

        $this->participation_type =
            $this->event->event_type === 'offline' ? 'offline' : 'online';
    }

    public function openJoinModal()
    {
        $this->openJoin = true;
    }

    public function joinEvent()
    {
        EventUser::create([
            'eventplace_id' => $this->event->id,
            'user_id' => auth()->id(),
            'participation_type' => $this->participation_type
        ]);

        session()->flash('success', 'You joined the event!');
        $this->openJoin = false;
    }
    public function render()
    {
        return view('livewire.user.event-library.show' , [
            'participants' => EventUser::where('eventplace_id', $this->event->id)->count()
        ]);
    }
}

