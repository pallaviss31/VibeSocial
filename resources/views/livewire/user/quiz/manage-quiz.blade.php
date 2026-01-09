<div class="max-w-7xl mx-auto space-y-6" x-data="{ editingQuiz: false, adding: false }">
 <div class="hidden lg:block w-1/4 left-10 fixed ">
        <div class="sticky top-24">
            <livewire:user.sidebar />
        </div>
    </div>
    <div class="flex bg-white border rounded-xl p-1 mt-7 ml-48 mb-6 w-56">

        {{-- All Quizzes --}}
        <a wire:navigate href="{{ route('quiz') }}"
            class="px-4 py-2 text-sm font-bold rounded-lg transition
       {{ request()->routeIs('quiz') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:text-indigo-600' }}">
            All Quizzes
        </a>

        {{-- Create Quiz --}}
        <a wire:navigate href="{{ route('quiz.create') }}"
            class="px-4 py-2 text-sm font-bold rounded-lg transition
       {{ request()->routeIs('quiz.create') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:text-indigo-600' }}">
            Create Quiz
        </a>

    </div>


    <!-- ================= HEADER ================= -->
    <div class="flex flex-col md:flex-row ml-48 md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-extrabold text-slate-800">
                Manage Quiz
            </h2>
            <p class="text-sm text-slate-500 capitalize">
                {{ $quiz->title }}
            </p>
        </div>

        <div class="flex gap-3">
            <a wire:navigate href="{{ route('quiz') }}"
                class="flex-1 py-2 px-3 rounded-xl bg-slate-200 font-bold text-sm text-center hover:bg-slate-300">
                Back to Quizzes
            </a>

            <button @click="editingQuiz = !editingQuiz"
                class="px-4 py-2 rounded-xl bg-indigo-600 text-white text-sm font-bold">
                Edit Quiz
            </button>

            <button wire:click="deleteQuiz" wire:confirm="Are you sure you want to delete this quiz?"
                class="px-4 py-2 rounded-xl bg-rose-600 text-white text-sm font-bold">
                Delete Quiz
            </button>
        </div>
    </div>


    <!-- ================= QUIZ DETAILS ================= -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 ml-48">

        <div class="bg-white border rounded-2xl p-5">
            <p class="text-xs text-slate-500">Course</p>
            <p class="font-bold text-slate-800 capitalize">
                {{ $quiz->course->course_name ?? 'General' }}
            </p>
        </div>

        <div class="bg-white border rounded-2xl p-5">
            <p class="text-xs text-slate-500">Total Questions</p>
            <p class="font-bold text-slate-800">
                {{ $quiz->total_questions }}
            </p>
        </div>

        <div class="bg-white border rounded-2xl p-5">
            <p class="text-xs text-slate-500">Status</p>
            <span
                class="inline-block mt-1 px-3 py-1 rounded-full text-xs font-bold
                {{ $quiz->is_published ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                {{ $quiz->is_published ? 'Published' : 'Draft' }}
            </span>
        </div>

        <div class="bg-white border rounded-2xl p-5">
            <p class="text-xs text-slate-500">Attempts</p>
            <p class="font-bold text-slate-800">
                {{ $quiz->attempts->count() }}
            </p>
        </div>

    </div>



    <!-- ================= EDIT QUESTIONS ================= -->
    <div x-show="editingQuiz" x-transition class="bg-white border ml-48 rounded-2xl overflow-hidden mt-6">

        <div class="px-6 py-4 border-b flex justify-between items-center">
            <h3 class="text-lg font-bold text-slate-800">
                Edit Questions
            </h3>

            <div class="flex gap-2">
                <button x-show="!adding" @click="adding = true"
                    class="px-4 py-2 rounded-xl bg-emerald-600 text-white text-sm font-bold">
                    + Add Question
                </button>

                <button wire:click="saveQuestions"
                    class="px-4 py-2 rounded-xl bg-indigo-600 text-white text-sm font-bold">
                    Save Changes
                </button>

                <button @click="editingQuiz = false; adding = false"
                    class="px-4 py-2 rounded-xl bg-slate-200 text-sm font-bold">
                    Cancel
                </button>
            </div>
        </div>

        <div class="p-6 space-y-6">

            @foreach ($questions as $index => $q)
                <div class="border rounded-2xl p-5 space-y-4">

                    <!-- QUESTION HEADER -->
                    <div class="flex justify-between items-center">
                        <h4 class="font-bold text-slate-700">
                            Question {{ $index + 1 }}
                        </h4>

                        <button wire:click="deleteQuestion({{ $q['id'] }})"
                            wire:confirm="Are you sure you want to delete this question?"
                            class="text-rose-600 text-xs font-bold hover:underline">
                            Delete
                        </button>
                    </div>

                    <!-- QUESTION -->
                    <textarea wire:model.defer="questions.{{ $index }}.question" class="w-full rounded-xl border px-4 py-2"
                        placeholder="Question {{ $index + 1 }}">
                    </textarea>

                    <!-- OPTIONS -->
                    <div class="grid sm:grid-cols-2 gap-3">
                        @foreach (['A', 'B', 'C', 'D'] as $oIndex => $label)
                            <label class="flex gap-2 items-center">
                                <input type="radio" wire:model="questions.{{ $index }}.correct"
                                    value="{{ $oIndex }}">

                                <input type="text"
                                    wire:model.defer="questions.{{ $index }}.options.{{ $oIndex }}"
                                    class="w-full rounded-xl border px-3 py-2"
                                    placeholder="Option {{ $label }}">
                            </label>
                        @endforeach
                    </div>

                </div>
            @endforeach


        </div>

    </div>

    <!-- ADD QUESTION FORM -->
    <div x-show="adding" x-transition class="border rounded-2xl p-5 ml-48 bg-slate-50 mb-6 space-y-4">

        <h4 class="font-bold text-slate-700">
            New Question
        </h4>

        <textarea wire:model.defer="newQuestion.question" class="w-full rounded-xl border px-4 py-2"
            placeholder="Enter question">
        </textarea>

        <div class="grid sm:grid-cols-2 gap-3">
            @foreach (['A', 'B', 'C', 'D'] as $i => $label)
                <label class="flex gap-2 items-center">
                    <input type="radio" wire:model="newQuestion.correct" value="{{ $i }}">

                    <input type="text" wire:model.defer="newQuestion.options.{{ $i }}"
                        class="w-full rounded-xl border px-3 py-2" placeholder="Option {{ $label }}">
                </label>
            @endforeach
        </div>

        <div class="flex gap-3">
            <button wire:click="addQuestion" @click="adding = false"
                class="px-4 py-2 rounded-xl bg-emerald-600 text-white text-sm font-bold">
                Save Question
            </button>

            <button @click="adding = false" class="px-4 py-2 rounded-xl bg-slate-200 text-sm font-bold">
                Cancel
            </button>
        </div>

    </div>


    @if (session()->has('message'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl p-4 mt-4">
            {{ session('message') }}
        </div>
    @endif



    <!-- ================= USER ATTEMPTS ================= -->
  <div x-data="{ tab: 'latest' }" class="bg-white ml-48 rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    
    <div class="px-6 py-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h3 class="text-lg font-bold text-slate-900">Quiz Submissions</h3>
            <p class="text-xs text-slate-500 mt-0.5">Overview of student performance</p>
        </div>

        <div class="flex p-1 bg-slate-100 rounded-xl w-fit">
            <button @click="tab = 'latest'" 
                :class="tab === 'latest' ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500 hover:text-slate-700'"
                class="px-4 py-1.5 text-xs font-bold rounded-lg transition-all duration-200">
                Latest Activity
            </button>
            <button @click="tab = 'leaderboard'" 
                :class="tab === 'leaderboard' ? 'bg-white text-indigo-600 shadow-sm' : 'text-slate-500 hover:text-slate-700'"
                class="px-4 py-1.5 text-xs font-bold rounded-lg transition-all duration-200">
                🏆 Leaderboard
            </button>
        </div>
    </div>

    <div class="divide-y divide-slate-100">
        
        <div x-show="tab === 'latest'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1">
            @php $latest = $quiz->attempts->sortByDesc('created_at')->take(6); @endphp
            @forelse ($latest as $attempt)
                <div class="px-6 py-4 flex items-center border border-l-0 border-r-0 hover:bg-slate-100 justify-between  transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="h-10 w-10 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <div class="">
                            <p class="text-sm font-bold text-slate-900    capitalize">{{ $attempt->user->fname }} {{ $attempt->user->lname }}</p>
                            <p class="text-xs text-slate-400">{{ $attempt->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <p class="text-sm font-bold text-slate-700">{{ $attempt->score }} pts</p>
                            <span class="text-[10px] font-bold uppercase {{ $attempt->score >= ($quiz->questions->count() * 0.4) ? 'text-emerald-500' : 'text-rose-500' }}">
                                {{ $attempt->score >= ($quiz->questions->count() * 0.4) ? 'Passed' : 'Failed' }}
                            </span>
                        </div>
                        <a wire:navigate href="{{ route('quiz.result', [$quiz->id, $attempt->id]) }}" class="p-2 bg-slate-50 rounded-lg text-slate-400 hover:text-indigo-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="py-12 text-center text-slate-400 text-sm">No submissions yet.</div>
            @endforelse
        </div>

        <div x-show="tab === 'leaderboard'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1">
            @php $leaderboard = $quiz->attempts->sortByDesc('score')->take(6); @endphp
            @forelse ($leaderboard as $index => $attempt)
                @php $rank = $index + 1; @endphp
                <div class="px-6 py-4 flex items-center justify-between border hover:bg-slate-100 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-6 text-center text-xs font-black {{ $rank <= 3 ? 'text-indigo-600' : 'text-slate-300' }}">
                            {{ $rank }}
                        </div>
                        <div class="h-10 w-10 rounded-xl bg-slate-900 flex items-center justify-center text-white font-bold text-xs">
                            {{ substr($attempt->user->fname, 0, 1) }}{{ substr($attempt->user->lname, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-900 capitalize">{{ $attempt->user->fname }} {{ $attempt->user->lname }}</p>
                            <div class="flex items-center gap-2">
                                <div class="w-16 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-indigo-500" style="width: {{ ($attempt->score / max($quiz->questions->count(), 1)) * 100 }}%"></div>
                                </div>
                                <span class="text-[10px] text-slate-400 font-bold">{{ round(($attempt->score / max($quiz->questions->count(), 1)) * 100) }}%</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        @if($rank == 1) 🥇 @elseif($rank == 2) 🥈 @elseif($rank == 3) 🥉 @endif
                        <div class="px-3 py-1 bg-indigo-50 rounded-lg border border-indigo-100">
                            <span class="text-sm font-black text-indigo-700">{{ $attempt->score }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-12 text-center text-slate-400 text-sm">No rankings yet.</div>
            @endforelse
        </div>

    </div>

    <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100">
        <button class="text-xs font-bold text-slate-500 hover:text-indigo-600 transition-colors flex items-center gap-2">
            View Full Report 
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </button>
    </div>
</div>