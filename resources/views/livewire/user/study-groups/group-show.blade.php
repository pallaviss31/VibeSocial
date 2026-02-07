<div class="max-w-5xl mx-auto p-6 space-y-6">

    <!-- Sidebar -->
    <div class="hidden lg:block fixed left-10 w-1/4">
        <div class="sticky top-24">
            <livewire:user.sidebar />
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-5xl mx-auto p-6 space-y-6">

        {{-- 🔒 PENDING / BLOCKED MESSAGE --}}
        @if (!$canView)
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6 text-center">
                <p class="text-yellow-700 text-sm">
                    Your request is pending admin approval.
                </p>
            </div>
        @endif

        {{-- 👑 ADMIN PANEL --}}
        @if ($isAdmin)
            <div class="bg-white border rounded-xl p-4 shadow mt-6">
                <h3 class="text-sm font-semibold mb-3 text-gray-700">Join Requests</h3>

                @forelse($requests as $request)
                    <div class="flex justify-between items-center border-b py-2">
                        <div class="flex items-center gap-3">
                            <img src="{{ $request->user->profile_image
                                ? asset('storage/' . $request->user->profile_image)
                                : 'https://ui-avatars.com/api/?name=' . urlencode($request->user->fname) }}"
                                class="w-9 h-9 rounded-full object-cover border">
                            <div>
                                <p class="text-sm font-medium text-gray-800">{{ $request->user->fname }}</p>
                                <p class="text-xs text-gray-500">Requested to join</p>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button wire:click="approve({{ $request->id }})"
                                class="px-3 py-1 text-xs rounded bg-green-600 text-white">Approve</button>
                            <button wire:click="reject({{ $request->id }})"
                                class="px-3 py-1 text-xs rounded bg-red-600 text-white">Reject</button>
                        </div>
                    </div>
                @empty
                    <p class="text-xs text-gray-500">No pending requests</p>
                @endforelse
            </div>
        @endif

        {{-- ✅ GROUP CONTENT --}}
        <div class="max-w-7xl mx-auto px-6 py-8 bg-gray-50 min-h-screen">

            <!-- GROUP HEADER -->
            <div class="bg-white rounded-3xl shadow overflow-hidden">

                {{-- GROUP COVER --}}
                <div class="h-64 md:h-80 rounded-3xl overflow-hidden shadow-lg relative group">
                    @if ($group->cover_image)
                        <img src="{{ asset('storage/' . $group->cover_image) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500">
                            <div class="absolute inset-0 opacity-30"></div>
                        </div>
                    @endif

                    {{-- Admin Cover Upload --}}
                    @if ($isAdmin)
                        <div
                            class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <form wire:submit.prevent="updateCover" enctype="multipart/form-data">
                                <input type="file" id="uploadCover" class="hidden" wire:model="cover">
                                <label for="uploadCover"
                                    class="bg-black/50 hover:bg-black/70 backdrop-blur-md
                                           text-white px-4 py-2 rounded-xl text-sm font-semibold
                                           cursor-pointer transition flex items-center gap-2
                                           border border-white/20">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    </svg>
                                    <span>Change Cover</span>
                                </label>
                                @if ($cover)
                                    <button type="submit" class="hidden"></button>
                                @endif
                            </form>
                        </div>
                    @endif
                </div>

                {{-- GROUP INFO --}}
                <div class="p-6 flex flex-col md:flex-row justify-between gap-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">{{ $group->name }}</h1>
                        <p class="text-sm text-indigo-600 mt-1">{{ $group->category }}</p>
                        <p class="mt-3 text-gray-600 max-w-2xl">{{ $group->description }}</p>
                    </div>

                    <div class="flex gap-4 text-center">
                        <div class="bg-indigo-50 px-5 py-3 rounded-xl">
                            <p class="text-xl font-bold text-indigo-700">{{ $group->members->count() }}</p>
                            <p class="text-xs text-gray-600">Members</p>
                        </div>
                        <div class="bg-green-50 px-5 py-3 rounded-xl">
                            <p class="text-xl font-bold text-green-700"> {{ $group->posts_count ?? 0 }}</p>
                            <p class="text-xs text-gray-600">Posts</p>
                        </div>
                    </div>
                </div>

                {{-- GROUP NAVIGATION --}}
                <div class="mt-8 border-t border-slate-100 pt-1 flex gap-6 overflow-x-auto no-scrollbar">
                    @foreach (['dashboard' => 'Dashboard', 'about' => 'About', 'members' => 'Members', 'media' => 'Media'] as $key => $label)
                        <button wire:click="setTab('{{ $key }}')"
                            class="pb-3 text-sm font-bold border-b-2 transition-colors whitespace-nowrap
                                {{ $activeTab === $key ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-slate-500 hover:text-slate-700' }}">
                            {{ $label }}
                        </button>
                    @endforeach
                    @if ($isAdmin)
                        <button wire:click="setTab('edit')"
                            class="pb-3 text-sm font-bold border-b-2 transition-colors whitespace-nowrap
                                {{ $activeTab === 'edit' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-slate-500 hover:text-slate-700' }}">
                            Settings
                        </button>
                    @endif
                </div>

                {{-- CONTENT GRID --}}
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mt-6">

                    {{-- LEFT COLUMN --}}
                    <div class="lg:col-span-8 space-y-6">
                        <div class="relative h-[calc(100vh-160px)] bg-slate-50 rounded-2xl overflow-hidden">
                            <div class="absolute inset-0 bottom-20 overflow-y-auto space-y-4 mb-4">

                                {{-- DASHBOARD --}}
                                {{-- DASHBOARD --}}
                                @if ($activeTab === 'dashboard')
                                    <livewire:user.study-groups.group-posts :group="$group" :canView="$canView"
                                        wire:key="group-posts-{{ $group->id }}-{{ $activeTab }}" />
                                @endif

                                {{-- ABOUT --}}
                                @if ($activeTab === 'about')
                                    <div class="p-4 text-gray-600">
                                        {{ $group->description }}
                                    </div>
                                @endif

                                {{-- MEMBERS --}}
                                @if ($activeTab === 'members')
                                    <livewire:user.study-groups.group-members :group="$group"
                                        wire:key="group-members-{{ $group->id }}" />
                                @endif

                                {{-- MEDIA --}}
                                @if ($activeTab === 'media')
                                    <div class="grid grid-cols-3 gap-4">
                                        @foreach ($group->posts()->whereNotNull('image')->take(6)->get() as $post)
                                            <img src="{{ asset('storage/' . $post->image) }}"
                                                class="w-full h-32 object-cover rounded-lg">
                                        @endforeach
                                    </div>
                                @endif

                                {{-- SETTINGS --}}
                                @if ($activeTab === 'edit' && $isAdmin)
                                    <div class="p-4 bg-white shadow rounded-lg">
                                        {{-- Include your group edit form here --}}
                                        <livewire:user.study-groups.group-edit :group="$group" />
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>

                    {{-- RIGHT COLUMN --}}
                    <div class="lg:col-span-4 space-y-6">

                        {{-- GROUP RULES --}}
                        <div class="bg-white p-5 rounded-xl shadow">
                            <h3 class="font-semibold mb-3">Group Rules</h3>
                            <ul class="text-sm text-gray-600 space-y-2">
                                @foreach ($group->rules ?? [] as $rule)
                                    <li>• {{ $rule }}</li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- MEMBERS LIST --}}
                        <div class="bg-white p-5 rounded-xl shadow">
                            <h3 class="font-semibold mb-3">Members</h3>
                            <div class="space-y-3">
                                @forelse($group->members as $user)
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $user->profile_image
                                            ? asset('storage/' . $user->profile_image)
                                            : 'https://ui-avatars.com/api/?name=' . urlencode($user->fname) }}"
                                            class="w-8 h-8 rounded-full object-cover">
                                        <p class="text-sm text-gray-700">{{ $user->fname }}</p>
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-400">No members yet</p>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
