<div
    class="fixed left-0 top-14 h-screen w-20 hover:w-72 group bg-white border-r border-slate-200 transition-all duration-300 ease-in-out overflow-x-hidden z-50 flex flex-col py-6">

    {{-- Profile Section --}}
    <div class="flex items-center gap-4 px-4 mb-8 min-w-[280px]">
        <div class="flex-shrink-0 w-12 h-12 rounded-full bg-indigo-100 border-2 border-white shadow-sm overflow-hidden">
            @if (auth()->user()->dp)
                <img src="{{ asset('storage/images/dp/' . auth()->user()->dp) }}" alt="Profile"
                    class="w-full h-full object-cover">
            @else
                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'User' }}&background=random"
                    alt="Profile" class="w-full h-full object-cover">
            @endif
        </div>
        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
            <a href="{{ route('profile') }}">
                <div class="font-bold text-lg text-slate-800 leading-tight">{{ auth()->user()->fname }}
                    {{ auth()->user()->lname }}</div>
                <div class="text-xs text-slate-500">Class of '25</div>
            </a>
        </div>
    </div>

    {{-- Navigation Sections --}}
    <div class="flex-1 space-y-8 px-4">

        {{-- Academic --}}
        <div>
            <h3
                class="hidden group-hover:block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 ml-2 transition-all">
                Academics</h3>
            <nav class="space-y-2">
                <a href="{{ route('courses') }}"
                    class="flex items-center gap-4 p-2 text-slate-600 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition-all group/item">
                    <div
                        class="flex-shrink-0 w-10 h-8 rounded-lg bg-slate-50 flex items-center justify-center group-hover/item:bg-indigo-600 group-hover/item:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="font-medium opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">My
                        Courses</span>
                </a>

                <a href="{{ route('assignments') }}"
                    class="flex items-center gap-4 p-2 text-slate-600 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition-all group/item">
                    <div
                        class="flex-shrink-0 w-10 h-8 rounded-lg bg-slate-50 flex items-center justify-center group-hover/item:bg-indigo-600 group-hover/item:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <span
                        class="font-medium opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Assignments</span>
                </a>

                <a href="{{ route('documents') }}"
                    class="flex items-center gap-4 p-2 text-slate-600 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition-all group/item">
                    <div
                        class="flex-shrink-0 w-10 h-8 rounded-lg bg-slate-50 flex items-center justify-center group-hover/item:bg-indigo-600 group-hover/item:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <span
                        class="font-medium opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Library</span>
                </a>
            </nav>
        </div>

        {{-- Campus Life --}}
        <div>
            <h3
                class="hidden group-hover:block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 ml-2">
                Campus Life</h3>
            <nav class="space-y-2">
                <a href="{{ route('grouplist') }}"
                    class="flex items-center gap-4 p-2 text-slate-600 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all group/item">
                    <div
                        class="flex-shrink-0 w-10 h-8 rounded-lg bg-slate-50 flex items-center justify-center group-hover/item:bg-orange-600 group-hover/item:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <span
                        class="font-medium opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Study
                        Groups</span>
                </a>

                 <a href="{{ route('place') }}"
                    class="flex items-center gap-4  p-2 text-slate-600 rounded-xl hover:bg-orange-50 hover:text-orange-600 transition-all group/item">
                    <div
                        class="flex-shrink-0 w-10 h-8 rounded-lg bg-slate-50 flex items-center justify-center group-hover/item:bg-orange-600 group-hover/item:text-white transition-colors">
                         <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    </div>
                    <span
                        class="font-medium opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Event</span>
                </a>

                <a href="{{ route('quiz') }}"
                    class="flex items-center gap-4 p-2 text-slate-600 rounded-xl hover:bg-pink-50 hover:text-pink-600 transition-all group/item">
                    <div
                        class="flex-shrink-0 w-10 h-8 rounded-lg bg-slate-50 flex items-center justify-center group-hover/item:bg-pink-600 group-hover/item:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                        </svg>
                    </div>
                    <span
                        class="font-medium opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Quiz
                        Time</span>
                </a>
            </nav>
        </div>

        {{-- Shortcuts --}}
        <div>
            <h3
                class="hidden group-hover:block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 ml-2">
                Shortcuts</h3>
            <nav class="space-y-2">
                <a href="#"
                    class="flex items-center gap-4 p-2 text-slate-600 rounded-xl hover:bg-slate-50 transition-all">
                    <img src="https://ui-avatars.com/api/?name=CS+101&background=random"
                        class="flex-shrink-0 w-10 h-10 rounded-lg object-cover">
                    <span class="font-medium opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">CS
                        101 Group</span>
                </a>
            </nav>
        </div>
    </div>
</div>
