<?php

namespace App\Livewire\User\EventLibrary;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\EventPlace;
use App\Models\EventUser;
use Livewire\Attributes\Layout;

#[Layout('components.layout.user')]
class EventCreate extends Component
{
    use WithFileUploads;

    public $title, $description, $image,
    $date, $time, $event_type = 'online', $venue, $meet_link;

    public function save()
    {
        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image',
            'date' => 'required',
            'time' => 'required',
            'event_type' => 'required'
        ]);

        $path = $this->image->store('events','public');

        EventPlace::create([
            'title' => $this->title,
            'description' => $this->description,
            'image' => $path,
            'date' => $this->date,
            'time' => $this->time,
            'event_type' => $this->event_type,
            'venue' => $this->venue,
            'meet_link' => $this->meet_link,
            'organizer_id' => auth()->id(),
        ]);

        session()->flash('success', 'Event Created Successfully!');
        return redirect('/place');
    }
    public function render()
    {
        return view('livewire.user.event-library.event-create');
    }
}
