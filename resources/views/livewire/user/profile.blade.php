<div class="max-w-7xl mx-auto px-4 lg:px-8 py-8">
    <!-- Profile Header -->
    <div class="relative mb-8">
        <!-- Cover Image -->
        <div class="h-64 md:h-80 rounded-3xl overflow-hidden shadow-lg relative group">
            @if ($selectedUser->cover)
                <img src="{{ asset('storage/images/cover/' . $selectedUser->cover) }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500">
                    <div class="absolute inset-0 opacity-30"></div>
                </div>
            @endif

            @if ($selectedUser->id == auth()->user()->id)
                <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <form wire:submit.prevent="updateProfile" method="post" enctype="multipart/form-data">
                        <input type="file" class="hidden" wire:model="cover" id="uploadCover">
                        <label for="uploadCover"
                            class="bg-black/50 hover:bg-black/70 backdrop-blur-md text-white px-4 py-2 rounded-xl text-sm font-semibold cursor-pointer transition flex items-center gap-2 border border-white/20">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            </svg>
                            <span>Change Cover</span>
                        </label>
                        <button type="submit" class="hidden"></button>
                    </form>
                </div>
            @endif
        </div>

        <!-- Profile Info Card -->
        <div class="mx-4 md:mx-8 -mt-20 relative z-10">
            <div
                class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 flex flex-col md:flex-row items-start md:items-end gap-6">
                <!-- Avatar -->
                <div class="relative -mt-20 md:-mt-24 flex-shrink-0 group">
                    <div
                        class="w-32 h-32 md:w-40 md:h-40 rounded-2xl border-4 border-white shadow-lg overflow-hidden bg-white">
                        <img src="@if ($selectedUser->dp) {{ asset('storage/images/dp/' . $selectedUser->dp) }} @else {{ asset('storage/dp.jpg') }} @endif"
                            class="w-full h-full object-cover">
                    </div>
                    @if ($selectedUser->id == auth()->user()->id)
                        <div
                            class="absolute inset-0 bg-black/40 rounded-2xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                            <form wire:submit.prevent="updateProfile" method="post" enctype="multipart/form-data">
                                <input type="file" class="hidden" wire:model="dp" id="uploadDp">
                                <label for="uploadDp" class="cursor-pointer text-white p-2">
                                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    </svg>
                                </label>
                                <button type="submit" class="hidden"></button>
                            </form>
                        </div>
                    @endif
                </div>

                <!-- Info -->
                <div class="flex-1 w-full md:w-auto">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <h1 class="text-3xl font-bold text-slate-900">{{ $selectedUser->fname }}
                                {{ $selectedUser->lname }}</h1>
                            <div class="flex flex-wrap items-center gap-3 mt-2 text-sm font-medium text-slate-600">
                                <span class="flex items-center gap-1 bg-indigo-50 text-indigo-700 px-2 py-1 rounded-lg">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 14l9-5-9-5-9 5 9 5z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                    </svg>
                                    Computer Science
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Class of 2025
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    New York, USA
                                </span>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            @if ($selectedUser->id == auth()->user()->id)
                                <button
                                 wire:click="$dispatch('openEditProfile')"
                                    class="bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 px-5 py-2.5 rounded-xl font-semibold shadow-sm transition flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    Edit Profile
                                </button>
                            @else
                                <livewire:user.friendship-button :selectedUser="$selectedUser" />
                                <a href="{{ route('messages') }}?user={{ $selectedUser->id }}"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-semibold shadow-lg shadow-indigo-200 transition flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                    </svg>
                                    Message
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Stats / Tabs -->
                    <div class="flex items-center gap-6 mt-6 border-t border-slate-100 pt-4">
                        <a href="#"
                            class="text-slate-900 font-semibold border-b-2 border-indigo-600 pb-4 -mb-4">
                            <span class="text-lg">Portfolio</span>
                        </a>
                        <a href="#"
                            class="text-slate-500 hover:text-slate-800 font-medium transition pb-4 -mb-4">
                            <span class="text-lg">Schedule</span>
                        </a>
                        <a href="#"
                            class="text-slate-500 hover:text-slate-800 font-medium transition pb-4 -mb-4 flex items-center gap-2">
                            <span class="text-lg">Classmates</span>
                            <span class="bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full text-xs">1.2k</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Info & Portfolio -->
        <div class="space-y-6">
            <!-- About Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <h3 class="font-bold text-slate-800 mb-4 text-lg flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    About Me
                </h3>
                <p class="text-slate-600 leading-relaxed mb-6">
                    {{ $selectedUser->bio ?? 'Student at University. Passionate about technology and design.' }}</p>

                <div class="space-y-4">
                    <div class="flex items-center gap-3 text-slate-600">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-500">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-xs text-slate-400 font-medium uppercase tracking-wider">Major</div>
                            <div class="font-semibold text-slate-800">Computer Science</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 text-slate-600">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-500">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-xs text-slate-400 font-medium uppercase tracking-wider">Joined</div>
                            <div class="font-semibold text-slate-800">{{ $selectedUser->created_at->format('F Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Skills -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                <h3 class="font-bold text-slate-800 mb-4 text-lg flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Skills & Interests
                </h3>
                <div class="flex flex-wrap gap-2">
                    <span
                        class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-lg text-sm font-medium border border-indigo-100">UI
                        Design</span>
                    <span
                        class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-lg text-sm font-medium border border-indigo-100">Laravel</span>
                    <span
                        class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-lg text-sm font-medium border border-indigo-100">React</span>
                    <span
                        class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-lg text-sm font-medium border border-indigo-100">Photography</span>
                    <span
                        class="px-3 py-1 bg-slate-50 text-slate-600 rounded-lg text-sm font-medium border border-slate-100">+
                        Add Skill</span>
                </div>
            </div>
        </div>

        <!-- Right Column: Feed -->
        <div class="lg:col-span-2 space-y-6">
            @if ($selectedUser->id == auth()->user()->id)
                <livewire:user.post.create-form />
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-4 flex items-center justify-between">
                <h3 class="font-bold text-slate-800">Activity</h3>
                <div class="flex gap-2">
                    <button class="px-3 py-1.5 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg">All
                        Posts</button>
                    <button
                        class="px-3 py-1.5 text-sm font-medium text-slate-500 hover:bg-slate-50 rounded-lg transition">Photos</button>
                    <button
                        class="px-3 py-1.5 text-sm font-medium text-slate-500 hover:bg-slate-50 rounded-lg transition">Videos</button>
                </div>
            </div>

            @livewire('user.post.calling-post', ['selectedUser' => $selectedUser])
        </div>
    </div>
</div>
