<div class="max-w-5xl mx-auto p-6 space-y-6">
    <div class="hidden lg:block fixed left-10 w-1/4">
        <div class="sticky top-24">
            <livewire:user.sidebar />
        </div>
    </div>
    <div class="max-w-5xl mx-auto p-6 space-y-6">

    <!-- Header -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold">Study Groups</h2>

        <a href="{{ route('groupcreate') }}"
           class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
            + Create Group
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white p-4 rounded-lg shadow flex flex-col md:flex-row gap-4">

        <input type="text"
               wire:model.debounce.500ms="search"
               placeholder="Search group..."
               class="border p-2 rounded-lg w-full">

        <select wire:model="subjectFilter" class="border p-2 rounded-lg">
            <option value="">All Subjects</option>
            <option value="Maths">Maths</option>
            <option value="Science">Science</option>
            <option value="History">History</option>
        </select>

        <select wire:model="visibilityFilter" class="border p-2 rounded-lg">
            <option value="">All</option>
            <option value="public">Public</option>
            <option value="private">Private</option>
        </select>
    </div>

    <!-- Groups -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        @foreach($groups as $group)

        <div class="bg-white border rounded-xl p-5">

            <!-- Cover -->
            <div class="h-32 bg-gray-100 mb-3">
                @if($group->cover_image)
                    <img src="{{ asset('storage/' . $group->cover_image) }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="h-full flex items-center justify-center text-gray-400">
                        No Cover Image
                    </div>
                @endif
            </div>

            <div class="flex justify-between">
                <div>
                    <h3 class="text-lg font-semibold">{{ $group->name }}</h3>
                    <p class="text-sm text-indigo-600">{{ $group->subject }}</p>
                </div>

                <span class="text-xs px-2 py-1 rounded-full
                    {{ $group->visibility === 'public'
                        ? 'bg-green-100 text-green-700'
                        : 'bg-gray-200 text-gray-700' }}">
                    {{ ucfirst($group->visibility) }}
                </span>
            </div>

            <p class="text-sm text-gray-600 mt-2 line-clamp-2">
                {{ $group->description }}
            </p>

            @php
                $membership = $group->members
                    ->where('user_id', auth()->id())
                    ->first();
            @endphp

            <div class="mt-4 flex justify-between items-center">
                <span class="text-xs text-gray-500">
                    {{ $group->members_count }} members
                </span>

                {{-- ACTION BUTTON --}}
                @if($membership && $membership->status === 'joined')

                    <a href="{{ route('groupshow', $group->id) }}"
                       class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
                        Explore
                    </a>

                @elseif($membership && $membership->status === 'requested')

                    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full">
                        Request Sent
                    </span>

                @else

                    @if($group->visibility === 'public')
                        <button wire:click="joinRequest({{ $group->id }})"
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                            Join
                        </button>
                    @else
                        <button wire:click="joinRequest({{ $group->id }})"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
                            Request to Join
                        </button>
                    @endif

                @endif
            </div>
        </div>

        @endforeach

    </div>
</div>
</div>