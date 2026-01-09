<div class="max-w-7xl mx-auto px-4 py-10 font-sans">
    <div class="hidden lg:block w-1/4 left-10 fixed ">
        <div class="sticky top-24">
            <livewire:user.sidebar />
        </div>
    </div>

    <!-- ================= HEADER ================= -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:ml-48 lg:pr-8 py-8">

        <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                    Practice Quizzes
                </h1>
                <p class="text-slate-500 text-sm mt-1 font-medium">
                    Sharpen your concepts with smart, time-bound quizzes.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                 <div class="flex p-1 bg-slate-100 rounded-xl border border-slate-200">
                <button
                    wire:click="$set('myQuiz', false)"
                    class="px-4 py-2 text-xs font-bold rounded-lg transition
                    {{ !$myQuiz ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">
                    All Quizzes
                </button>

                <button
                    wire:click="$set('myQuiz', true)"
                    class="px-4 py-2 text-xs font-bold rounded-lg transition
                    {{ $myQuiz ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">
                    My Quizzes
                </button>
            </div>

                <button wire:click="$toggle('showCreateModal')"
                    class="group relative overflow-hidden px-5 py-2.5 rounded-xl font-bold text-sm text-white
                       transition-all duration-300 shadow-md active:scale-95
                       {{ $showCreateModal ? 'bg-slate-700 hover:bg-slate-800' : 'bg-indigo-600 hover:bg-indigo-700 shadow-indigo-100' }}">
                    <span class="relative z-10 flex items-center gap-2">
                        {{ $showCreateModal ? '✕ Cancel' : '＋ Create Quiz' }}
                    </span>
                    <span
                        class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                </button>
            </div>
        </div>

        @if ($showCreateModal)
            <div class="mb-10 transition-all duration-500 ease-in-out">
                <livewire:quiz.create-quiz />
            </div>
        @endif

        <div
            class="bg-white/90 backdrop-blur-md rounded-2xl shadow-sm border border-slate-200 p-6 mb-8 transition-all hover:shadow-md">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-slate-400 group-focus-within:text-indigo-500 transition-colors"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search quiz..."
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-10 pr-4 py-2.5 text-sm
                    focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all" />
                </div>

                <div class="relative">
                    <select wire:model.live="courseFilter"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm appearance-none
                    focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all cursor-pointer">
                        <option value="">All Courses</option>
                         @foreach ($courses as $course)
                            <option value="{{ $course->id }}">
                                {{ $course->name }} ({{ $course->semester }})
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </div>
                </div>

                 <button
                wire:click="toggleSort"
                class="flex items-center gap-2 bg-indigo-50 text-indigo-700 font-bold rounded-xl px-4 py-2.5 text-sm
                       hover:bg-indigo-100 transition border border-indigo-100">
                <span>
                    {{ $sortDirection === 'desc' ? 'Latest First' : 'Oldest First' }}
                </span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </button>
            </div>
        </div>
    </div>
    <!-- ================= QUIZ GRID ================= -->
    <div class="grid grid-cols-1 md:grid-cols-2 ml-48 lg:grid-cols-3 gap-6">
        @forelse ($quizzes as $quiz)
            <!-- ================= QUIZ CARD ================= -->
            <div
                class="group bg-white rounded-2xl border border-slate-100 shadow-sm
                   hover:shadow-xl hover:-translate-y-1 transition-all duration-300
                   p-6 relative overflow-hidden">

                <div
                    class="absolute inset-0 opacity-0 group-hover:opacity-100 transition
                        bg-gradient-to-br from-indigo-50/40 to-transparent">
                </div>

                <div class="relative">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex flex-wrap gap-2">
                            <span class="badge-indigo">{{ $quiz->subject }}</span>
                            @if (!$quiz->is_published)
                                <span class="badge-gray">Draft</span>
                            @elseif ($quiz->status === 'pending')
                                <span class="badge-yellow">Pending</span>
                            @else
                                <span class="badge-green">Live</span>
                            @endif

                        </div>
                        <button class="text-slate-300 hover:text-indigo-500 transition">
                            🔖
                        </button>
                    </div>

                    <h2 class="text-lg font-bold text-slate-800 leading-snug">
                        {{ $quiz->title }}
                    </h2>
                    <p class="text-sm text-slate-500 mt-2 line-clamp-2">
                        {{ $quiz->description }}
                    </p>

                    <div class="grid grid-cols-2 gap-4 mt-6 py-4 border-y border-slate-100 text-sm">
                        <div class="flex items-center gap-2 text-slate-600">
                            ⏱️ <span class="font-medium">{{ $quiz->time_limit }} Mins</span>
                        </div>
                        <div class="text-right text-slate-600">
                            📝 <span class="font-medium">{{ $quiz->total_questions }} Questions</span>
                        </div>
                    </div>
                    {{-- button --}}
                    @php
                        $isCreator = auth()->id() === $quiz->created_by;
                        $attempt = $quiz->attempts->where('user_id', auth()->id())->first();
                    @endphp

                    {{-- 1️⃣ Draft quiz (creator only) --}}
                    @if (!$quiz->is_published && $isCreator)
                        <a href="{{ route('quiz.manage', $quiz->id) }}"
                            class="w-full bg-slate-600 text-white py-2 rounded-xl text-center block hover:bg-slate-700 transition">
                            Continue Editing
                        </a>

                        {{-- 2️⃣ Published & approved --}}
                    @elseif ($quiz->is_published && $quiz->status === 'approved')
                        {{-- Creator --}}
                        @if ($isCreator)
                            <a href="{{ route('manage', $quiz->id) }}"
                                class="w-full bg-indigo-600 text-white py-2 rounded-xl text-center block hover:bg-indigo-700 transition">
                                Manage Quiz
                            </a>

                            {{-- Non-creator --}}
                        @else
                            {{-- Attempted --}}
                            @if ($attempt)
                                <a href="{{ route('quiz.result', $quiz->id) }}"
                                    class="mt-4 w-full bg-white border border-emerald-200 text-emerald-700
                       font-bold py-2.5 rounded-xl text-center block hover:bg-emerald-50 transition">
                                    Review Results
                                </a>

                                {{-- Not attempted --}}
                            @else
                                <a href="{{ route('start.quiz', $quiz->id) }}"
                                    class="mt-4 w-full bg-emerald-600 text-white py-2.5 rounded-xl text-center block hover:bg-emerald-700 transition">
                                    Start Quiz
                                </a>
                            @endif
                        @endif

                        {{-- 3️⃣ Pending approval --}}
                    @elseif ($quiz->is_published && $quiz->status === 'pending' && $isCreator)
                        <span class="block text-center text-sm text-slate-400 italic">
                            Waiting for admin approval
                        </span>
                    @endif



                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16 text-slate-500">
                No quizzes available yet.
            </div>
        @endforelse

        <!-- ================= COMPLETED QUIZ ================= -->
        <div class="bg-slate-50/60 rounded-2xl border border-emerald-200 p-6 relative overflow-hidden">

            <div class="absolute -right-6 -top-6 opacity-10 text-emerald-600 text-8xl">✔</div>

            <div class="flex justify-between items-start mb-4">
                <span class="badge-gray">History</span>
                <span class="badge-success">Completed</span>
            </div>

            <h2 class="text-lg font-bold text-slate-800">
                Modern India: 1857 Revolt
            </h2>

            <div class="mt-6 p-4 bg-white rounded-xl border border-emerald-100">
                <div class="flex justify-between items-end">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase">
                            Best Score
                        </p>
                        <p class="text-xl font-black text-emerald-600">85%</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] font-bold text-slate-400 uppercase">
                            Rank
                        </p>
                        <p class="text-sm font-bold text-slate-700">#4 / 1.2k</p>
                    </div>
                </div>

                <div class="w-full bg-slate-100 h-1.5 rounded-full mt-2">
                    <div class="bg-emerald-500 h-1.5 rounded-full" style="width:85%"></div>
                </div>
            </div>

            <button
                class="mt-6 w-full bg-white border border-slate-200 text-slate-600
                       font-bold py-3 rounded-xl hover:bg-slate-50 transition">
                Review Results
            </button>
        </div>

    </div>
</div>
