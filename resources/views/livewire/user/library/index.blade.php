<div class="min-h-screen bg-slate-50 p-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex gap-6">

            <!-- Sidebar (Left) -->
           <div class="hidden lg:block w-1/4 left-10 fixed ">
            <div class="sticky top-24">
                <livewire:user.sidebar />
            </div>
        </div>

            <!-- Main Content -->
            <main class="flex-1 space-y-6 ml-72">

                <!-- Search + Actions -->
                <div class="flex flex-col md:flex-row items-center gap-3 bg-white p-4 rounded-lg shadow-sm">

                    <div class="flex-1 w-full">
                        <input wire:model.debounce.450ms="search" type="text"
                            placeholder="Search title, description or subject..."
                            class="w-full px-4 py-2 rounded-lg border focus:ring focus:ring-blue-200" />
                    </div>

                    <div class="flex gap-2 w-full md:w-auto">
                        <button wire:click="clearFilters"
                            class="px-4 py-2 border rounded-lg bg-white shadow-sm hover:bg-slate-100 transition">
                            Clear
                        </button>

                        <a href="{{ route('documents') }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                            Reset URL
                        </a>
                    </div>
                </div>

                <!-- Filters -->
                <!-- Filters + Upload Button Row -->
                <div class="bg-white p-4 rounded-lg shadow-sm">

                    <!-- Filters Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                        <select wire:model="branch" class="px-3 py-2 rounded-lg border bg-white">
                            <option value="">All Branches</option>
                            @foreach ($branches as $b)
                                <option value="{{ $b }}">{{ $b }}</option>
                            @endforeach
                        </select>

                        <select wire:model="semester" class="px-3 py-2 rounded-lg border bg-white">
                            <option value="">All Semesters</option>
                            @foreach ($semesters as $s)
                                <option value="{{ $s }}">{{ $s }}</option>
                            @endforeach
                        </select>

                        <select wire:model="type" class="px-3 py-2 rounded-lg border bg-white">
                            <option value="">All Types</option>
                            @foreach ($types as $t)
                                <option value="{{ $t }}">{{ ucfirst($t) }}</option>
                            @endforeach
                        </select>

                        <select wire:model="sort" class="px-3 py-2 rounded-lg border bg-white">
                            <option value="newest">Newest</option>
                            <option value="downloads">Most Downloaded</option>
                            <option value="views">Most Viewed</option>
                        </select>

                    </div>

                    <!-- Upload Toggle Button -->
                    <button wire:click="toggleCreate"
                        class="{{ $isCreating ? 'bg-slate-100 text-slate-600 hover:bg-slate-200' : 'bg-indigo-600 text-white hover:bg-indigo-700 shadow-md shadow-indigo-200' }} 
           font-bold px-4 py-2 rounded-xl transition flex items-center gap-2">

                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            @if ($isCreating)
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            @else
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            @endif
                        </svg>

                        {{ $isCreating ? 'Cancel Upload' : 'Upload Document' }}
                    </button>
                </div>
                {{-- upload  --}}
                @if ($isCreating)
                    <livewire:user.library.upload />
                @endif


                <!-- Documents Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($documents as $doc)
                        <div class="bg-white rounded-xl shadow p-4 flex flex-col hover:shadow-md transition">

                            <div class="h-36 bg-gray-100 rounded flex items-center justify-center overflow-hidden">
                                @if ($doc->thumbnail)
                                    <img src="{{ asset('storage/documents/' . $doc->thumbnail) }}"
                                        class="h-full w-full object-cover" alt="Document Thumbnail" />
                                @else
                                    <img src="https://cdn-icons-png.flaticon.com/512/337/337946.png"
                                        class="h-16 opacity-60" alt="PDF Icon">
                                @endif
                            </div>


                            <h3 class="mt-3 font-semibold text-lg">{{ $doc->title }}</h3>
                            <p class="text-sm text-gray-500">
                                {{ $doc->branch }} • {{ $doc->semester }} • {{ ucfirst($doc->type) }}
                            </p>

                            <div class="mt-3 flex items-center justify-between text-sm text-gray-600">
                                <span>⭐ {{ number_format($doc->rating ?? 0, 1) }}</span>
                                <span>{{ $doc->views }} views • {{ $doc->downloads }} downloads</span>
                            </div>

                            <div class="mt-3 flex gap-2">
                                <button wire:click="$dispatch('open-document', { id: {{ $doc->id }} })"
                                    class="px-3 py-1 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">
                                    View
                                </button>



                                <a href="" class="px-3 py-2 border rounded-lg hover:bg-slate-100 transition">
                                    Download
                                </a>
                            </div>

                        </div>
                    @empty
                        <div class="col-span-full p-6 bg-white rounded-lg text-center text-gray-500">
                            No documents found.
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if ($documents->hasPages())
                    <div class="mt-6">
                        {{ $documents->links() }}
                    </div>
                @endif

            </main>

        </div>
    </div>
</div>
