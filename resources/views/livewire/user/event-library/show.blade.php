<div class="max-w-4xl mx-auto py-10">

    @if(session('success'))
        <div class="p-3 bg-green-100 text-green-700 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-white p-6 rounded-xl shadow">
        <img src="{{ asset('storage/'.$event->image) }}" class="w-full h-64 object-cover rounded mb-4">

        <h1 class="text-3xl font-bold">{{ $event->title }}</h1>
        <p class="text-gray-700 mt-2">{{ $event->description }}</p>

        <div class="grid grid-cols-2 gap-4 mt-4">
            <p><strong>Date:</strong> {{ $event->date }}</p>
            <p><strong>Time:</strong> {{ $event->time }}</p>
            <p><strong>Type:</strong> {{ ucfirst($event->event_type) }}</p>

            @if($event->venue)
            <p><strong>Venue:</strong> {{ $event->venue }}</p>
            @endif

            @if($event->meet_link)
            <p><strong>Meet Link:</strong> {{ $event->meet_link }}</p>
            @endif
        </div>

        <div class="mt-6">
            <button wire:click="openJoinModal"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                Join Event
            </button>
        </div>
    </div>

    @if($openJoin)
    <div class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center">
        <div class="bg-white w-full max-w-md p-6 rounded-xl">
            <h2 class="text-xl font-bold mb-3">Join Event</h2>

            <select wire:model="participation_type" class="w-full p-2 border rounded mb-4">
                <option value="online">Online</option>
                <option value="offline">Offline</option>
            </select>

            <button wire:click="joinEvent" class="px-4 py-2 bg-green-600 text-white rounded">Confirm</button>
            <button wire:click="$set('openJoin', false)" class="px-4 py-2 bg-gray-500 text-white rounded ml-3">Cancel</button>
        </div>
    </div>
    @endif

</div>
