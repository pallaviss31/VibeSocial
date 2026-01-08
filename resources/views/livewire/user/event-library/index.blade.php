<div class="max-w-7xl mx-auto py-10 flex gap-8">

    <!-- Sidebar -->
    <div class="hidden lg:block fixed left-10 w-1/4">
        <div class="sticky top-24">
            <livewire:user.sidebar />
        </div>
    </div>

    <!-- Main Content -->
    <div class="w-full lg:w-3/4 space-y-8 ml-60">

        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold text-gray-900">Events</h1>

            <button wire:click="toggleCreate"
                class="{{ $isCreating
                    ? 'bg-gray-200 text-gray-700 hover:bg-gray-300'
                    : 'bg-indigo-600 text-white hover:bg-indigo-700 shadow-md shadow-indigo-200' }}
                    font-semibold px-5 py-2.5 rounded-lg transition flex items-center gap-2">

                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    @if ($isCreating)
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    @else
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    @endif
                </svg>

                {{ $isCreating ? 'Cancel' : 'Add Event' }}
            </button>
        </div>

        <!-- Create Form -->
        @if ($isCreating)
            <div class="bg-white p-5 rounded-xl shadow-md border">
                <livewire:user.event-library.event-create />
            </div>
        @endif

        <!-- Search + Filters -->
        <div class="bg-white p-5 rounded-xl shadow-md space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <input type="text" wire:model.live="search" placeholder="Search events..."
                    class="w-full p-2.5 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">

                <div class="md:col-span-2 flex gap-2 justify-end">
                    @php
                        $filters = [
                            'all' => 'All',
                            'today' => 'Today',
                            'upcoming' => 'Upcoming',
                            'past' => 'Past',
                        ];
                    @endphp

                    @foreach ($filters as $key => $label)
                        <button wire:click="setFilter('{{ $key }}')"
                            class="px-4 py-2 rounded-lg text-sm font-medium
                            {{ $filter == $key ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            {{ $label }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Events -->
        <div class="space-y-6 p-6">

            @foreach ($events as $event)

                @php
                    $status = ['Expired', 'bg-red-100 text-red-800'];
                    if ($event->date == now()->toDateString()) {
                        $status = ['Today', 'bg-yellow-100 text-yellow-800'];
                    } elseif ($event->date > now()->toDateString()) {
                        $status = ['Upcoming', 'bg-green-100 text-green-800'];
                    }

                    $join = $event->participants->first();
                @endphp

                <!-- GRID PER EVENT -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

                    <!-- EVENT CARD -->
                    <div class="lg:col-span-2 flex bg-white rounded-xl shadow border overflow-hidden">

                        <!-- Image -->
                        <div class="w-40 h-40 flex-shrink-0">
                            @if ($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-200"></div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="flex-1 p-4 space-y-2">

                            <div class="flex items-center justify-between">
                                <h2 class="text-lg font-semibold">{{ $event->title }}</h2>
                                <span class="px-2 py-1 text-xs rounded-full {{ $status[1] }}">
                                    {{ $status[0] }}
                                </span>
                            </div>

                            <div class="flex items-center gap-3">
                                <img src="{{ $event->organizer->profile ?? 'https://ui-avatars.com/api/?name=' . urlencode($event->organizer->fname) }}"
                                    class="w-8 h-8 rounded-full border">
                                <p class="text-xs text-gray-500">
                                    Organizer by
                                    <span class="font-semibold text-blue-600">
                                        {{ $event->organizer->fname }}
                                    </span>
                                </p>
                            </div>

                            <p class="text-sm text-gray-600">
                                📅 {{ $event->date }} | 🕒 {{ $event->time }}
                            </p>

                            <p class="text-sm text-gray-500 line-clamp-1">
                                {{ $event->description }}
                            </p>

                            <!-- Actions -->
                            <div class="pt-2">
                                @if (auth()->id() !== $event->organizer_id)
                                    @if (!$join)
                                        <button wire:click="joinEvent({{ $event->id }})"
                                            class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">
                                            Join Event
                                        </button>
                                    @elseif ($join->status === 'pending')
                                        <p class="text-yellow-600 font-medium text-sm">Request Pending</p>
                                    @elseif ($join->status === 'approved')
                                        <p class="text-green-600 font-medium text-sm">You Joined</p>
                                    @else
                                        <p class="text-red-600 font-medium text-sm">Request Rejected</p>
                                    @endif
                                @else
                                    <div class="flex gap-2">
                                        <button class="bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm">
                                            Edit
                                        </button>
                                        <button class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm">
                                            Delete
                                        </button>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>

                    <!-- JOIN REQUESTS (ADMIN ONLY) -->
                    @if (auth()->id() === $event->organizer_id)
    <div class="bg-white rounded-xl shadow border p-4 h-fit sticky top-28">

        <h3 class="text-sm font-semibold mb-3">Join Requests</h3>

        @if ($event->joinRequests->count())
            <div class="space-y-3 max-h-48 overflow-y-auto">

                @foreach ($event->joinRequests as $request)
                    <div
                        wire:key="request-{{ $request->id }}"
                        class="flex items-center justify-between border rounded-lg p-2">

                        <div class="flex items-center gap-2">
                            <img
                                src="{{ $request->user->profile ?? 'https://ui-avatars.com/api/?name=' . urlencode($request->user->fname) }}"
                                class="w-8 h-8 rounded-full">

                            <span class="text-sm font-medium truncate">
                                {{ $request->user->fname }}
                            </span>
                        </div>

                        <div class="flex gap-1">
                            <button
                                wire:click="approveRequest({{ $request->id }})"
                                class="px-2 py-1 text-xs bg-green-600 text-white rounded">
                                ✓
                            </button>

                            <button
                                wire:click="rejectRequest({{ $request->id }})"
                                class="px-2 py-1 text-xs bg-red-600 text-white rounded">
                                ✕
                            </button>
                        </div>

                    </div>
                @endforeach

            </div>
        @else
            <p class="text-sm text-gray-500">No pending requests</p>
        @endif

    </div>
@endif


                </div>
            @endforeach

        </div>
    </div>
</div>
