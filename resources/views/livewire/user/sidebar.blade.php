<div class="space-y-8 hover:overflow ">
    {{-- Profile --}}
    <div class="flex items-center gap-3 px-2">
        <div class="w-12 h-12 rounded-full bg-indigo-100 border-2 border-white shadow-sm overflow-hidden">
            @if (auth()->user()->dp)
                <img src="{{ asset('storage/images/dp/' . auth()->user()->dp) }}" alt="Profile"
                    class="w-full h-full  bg-cover">
            @else
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'User' }}&background=random"
                    alt="Profile" class="w-full h-full  bg-cover">
            @endif

        </div>
        <div>
            <a href="{{ route('profile') }}">
                <div class="font-bold text-2xl text-slate-800 font-cursive">{{ auth()->user()->fname }}
                    {{ auth()->user()->lname }}</div>
                <div class="text-xs text-slate-500 font-medium">Computer Science • Class of '25</div>
            </a>
        </div>
    </div>
    {{-- Academic --}}
    <div>
        <h3 class="px-2 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Academics</h3>
        <nav class="space-y-1">
            <a href="{{ route('courses') }}"
                class="flex items-center gap-3 px-3 w-64 py-2 text-slate-600 rounded-xl hover:bg-white hover:shadow-sm hover:text-indigo-600 transition group">
                <div
                    class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <span class="font-medium">My Courses</span>
            </a>
            <a href="{{ route('assignments') }}"
                class="flex w-64 items-center gap-3 px-3 py-2 text-slate-600 rounded-xl hover:bg-white hover:shadow-sm hover:text-indigo-600 transition group">
                <div
                    class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
                <span class="font-medium">Assignments</span>
                {{-- @if ($assignmentsCount > 0)
                    <span class="ml-auto bg-red-100 text-red-600 text-xs font-bold px-2 py-0.5 rounded-full">{{ $assignmentsCount }}</span>
                @endif --}}
            </a>
            <a href="{{ route('documents') }}"
                class="flex items-center gap-3 w-64 px-3 py-2 text-slate-600 rounded-xl hover:bg-white hover:shadow-sm hover:text-indigo-600 transition group">
                <div
                    class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <span class="font-medium">Library</span>
            </a>
        </nav>
    </div>
    <!-- Campus Life -->
    <div>
        <h3 class="px-2 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Campus Life</h3>
        <nav class="space-y-1">
            <a href="{{ route('grouplist') }}"
                class="flex items-center gap-3  w-64 px-3 py-2 text-slate-600 rounded-xl hover:bg-white hover:shadow-sm hover:text-indigo-600 transition group">
                <div
                    class="w-8 h-8 rounded-lg bg-orange-50 text-orange-600 flex items-center justify-center group-hover:bg-orange-600 group-hover:text-white transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <span class="font-medium">Study Groups</span>
            </a>
            <a href="{{ route('place') }}"
                class="flex  w-64 items-center gap-3 px-3 py-2 text-slate-600 rounded-xl hover:bg-white hover:shadow-sm hover:text-indigo-600 transition group">
                <div
                    class="w-8 h-8 rounded-lg bg-green-50 text-green-600 flex items-center justify-center group-hover:bg-green-600 group-hover:text-white transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <span class="font-medium">Events</span>
            </a>
            <a href="{{ route('find.friends') }}"
                class="flex w-64 items-center gap-3 px-3 py-2 text-slate-600 rounded-xl hover:bg-white hover:shadow-sm hover:text-indigo-600 transition group">
                <div
                    class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <span class="font-medium">Find Classmates</span>
            </a>

            <a href="{{ route('quiz') }}"
                class="flex w-64 items-center gap-3 px-3 py-2 text-slate-600 rounded-xl hover:bg-white hover:shadow-sm hover:text-indigo-600 transition group">
                <div
                    class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-pink-600 group-hover:text-white transition">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                    </svg>
                </div>
                <span class="font-medium">Quiz Time</span>
            </a>


        </nav>
    </div>
    <div>
        <h3 class="px-2 text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Shortcuts</h3>
        <nav class="space-y-1">
            <a href="#"
                class="flex items-center gap-3 px-3 w-64 py-2 text-slate-600 rounded-xl hover:bg-white hover:shadow-sm transition group">
                <img src="https://ui-avatars.com/api/?name=CS+101&background=random"
                    class="w-8 h-8 rounded-lg object-cover">
                <span class="font-medium">CS 101 Study Group</span>
            </a>
            <a href="#"
                class="flex items-center gap-3 px-3 w-64 py-2 text-slate-600 rounded-xl hover:bg-white hover:shadow-sm transition group">
                <img src="https://ui-avatars.com/api/?name=Chess+Club&background=random"
                    class="w-8 h-8 rounded-lg object-cover">
                <span class="font-medium">Chess Club</span>
            </a>
             <a href="#"
                class="flex items-center gap-3 px-3 w-64 py-2 text-slate-600 rounded-xl hover:bg-white hover:shadow-sm transition group">
                <img src="https://ui-avatars.com/api/?name=Chess+Club&background=random"
                    class="w-8 h-8 rounded-lg object-cover">
                <span class="font-medium">Chess Club</span>
            </a>
        </nav>
    </div>




</div>
