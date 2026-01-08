<div class="max-w-3xl mx-auto py-10">

    @if (session('success'))
        <div class="p-3 mb-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-2xl font-bold mb-6">Create New Event</h2>

        <form wire:submit.prevent="save" class="space-y-5">

            <!-- Title -->
            <div>
                <label class="block mb-1 font-semibold">Title</label>
                <input type="text" wire:model="title"
                       class="w-full p-2 border rounded">
                @error('title') 
                    <span class="text-red-600 text-sm">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block mb-1 font-semibold">Description</label>
                <textarea wire:model="description" rows="4"
                          class="w-full p-2 border rounded"></textarea>
                @error('description') 
                    <span class="text-red-600 text-sm">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Image Upload -->
            <div>
                <label class="block mb-1 font-semibold">Event Image</label>
                <input type="file" wire:model="image"
                       class="w-full p-2 border rounded">
                @error('image') 
                    <span class="text-red-600 text-sm">{{ $message }}</span> 
                @enderror

                @if ($image)
                    <img src="{{ $image->temporaryUrl() }}"
                         class="w-full h-48 object-cover rounded mt-3">
                @endif
            </div>

            <!-- Date & Time -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">Date</label>
                    <input type="date" wire:model="date"
                           class="w-full p-2 border rounded">
                    @error('date') 
                        <span class="text-red-600 text-sm">{{ $message }}</span> 
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Time</label>
                    <input type="time" wire:model="time"
                           class="w-full p-2 border rounded">
                    @error('time') 
                        <span class="text-red-600 text-sm">{{ $message }}</span> 
                    @enderror
                </div>
            </div>

            <!-- Event Type -->
            <div>
                <label class="block mb-1 font-semibold">Event Type</label>
                <select wire:model="event_type"
                        class="w-full p-2 border rounded">
                    <option value="online">Online</option>
                    <option value="offline">Offline</option>
                </select>
                @error('event_type') 
                    <span class="text-red-600 text-sm">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Show Venue only if offline -->
            @if ($event_type === 'offline')
                <div>
                    <label class="block mb-1 font-semibold">Venue</label>
                    <input type="text" wire:model="venue"
                        class="w-full p-2 border rounded">
                    @error('venue') 
                        <span class="text-red-600 text-sm">{{ $message }}</span> 
                    @enderror
                </div>
            @endif

            <!-- Show Meet Link only if online -->
            @if ($event_type === 'online')
                <div>
                    <label class="block mb-1 font-semibold">Meet Link</label>
                    <input type="text" wire:model="meet_link"
                        class="w-full p-2 border rounded">
                    @error('meet_link') 
                        <span class="text-red-600 text-sm">{{ $message }}</span> 
                    @enderror
                </div>
            @endif

            <!-- Submit Button -->
            <div class="pt-3">
                <button type="submit"
                    class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Create Event
                </button>
            </div>

        </form>
    </div>
</div>
