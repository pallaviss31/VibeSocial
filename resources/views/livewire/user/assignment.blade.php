<div class="max-w-7xl mx-auto px-4 lg:px-8 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Left Sidebar -->
   
  <div class="hidden lg:block w-1/4 left-10 fixed ">
            <div class="sticky top-24">
                <livewire:user.sidebar />
            </div>
        </div>
        <!-- Main Content -->
        <div class="w-full lg:w-3/4 ml-52">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">Assignments</h2>
                    <p class="text-slate-500">Manage your coursework and deadlines</p>
                </div>
                <button wire:click="toggleCreate" class="{{ $isCreating ? 'bg-slate-100 text-slate-600 hover:bg-slate-200' : 'bg-indigo-600 text-white hover:bg-indigo-700 shadow-md shadow-indigo-200' }} font-bold px-4 py-2 rounded-xl transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        @if($isCreating)
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        @else
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        @endif
                    </svg>
                    {{ $isCreating ? 'Cancel' : 'Add Assignment' }}
                </button>
            </div>

            <!-- Create Form -->
            @if($isCreating)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-6">
                <h3 class="font-bold text-slate-800 mb-4">New Assignment</h3>
                <form wire:submit.prevent="create" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Title</label>
                            <input type="text" wire:model="title" class="w-full rounded-xl border border-slate-200 px-4 py-2 focus:border-indigo-500 focus:ring-indigo-500">
                            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Course Name</label>
                            <input type="text" wire:model="course_name" class="w-full rounded-xl border border-slate-200 px-4 py-2 focus:border-indigo-500 focus:ring-indigo-500">
                            @error('course_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Due Date</label>
                            <input type="datetime-local" wire:model="due_date" class="w-full rounded-xl border border-slate-200 px-4 py-2 focus:border-indigo-500 focus:ring-indigo-500">
                            @error('due_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                        <textarea wire:model="description" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-2 focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-6 py-2 rounded-xl shadow-md shadow-indigo-200 transition">
                            Save Assignment
                        </button>
                    </div>
                </form>
            </div>
            @endif

            <!-- Filters -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-4 mb-6 flex items-center gap-4 overflow-x-auto no-scrollbar">
                <button wire:click="setFilter('all')" class="px-4 py-2 {{ $filter === 'all' ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-600 font-medium hover:bg-slate-50' }} rounded-xl text-sm whitespace-nowrap transition">All Assignments</button>
                <button wire:click="setFilter('pending')" class="px-4 py-2 {{ $filter === 'pending' ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-600 font-medium hover:bg-slate-50' }} rounded-xl text-sm whitespace-nowrap transition">Pending</button>
                <button wire:click="setFilter('completed')" class="px-4 py-2 {{ $filter === 'completed' ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-600 font-medium hover:bg-slate-50' }} rounded-xl text-sm whitespace-nowrap transition">Completed</button>
                <button wire:click="setFilter('overdue')" class="px-4 py-2 {{ $filter === 'overdue' ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-600 font-medium hover:bg-slate-50' }} rounded-xl text-sm whitespace-nowrap transition">Overdue</button>
            </div>

            <!-- Assignment List -->
            <div class="space-y-4">
                @forelse($assignments as $assignment)
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 hover:shadow-md transition duration-300 flex flex-col md:flex-row gap-4 items-start md:items-center">
                    <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex flex-col items-center justify-center border border-indigo-100 flex-shrink-0">
                        <span class="text-xs font-bold uppercase">{{ $assignment->due_date->format('M') }}</span>
                        <span class="text-lg font-bold leading-none">{{ $assignment->due_date->format('d') }}</span>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="bg-indigo-100 text-indigo-700 text-xs font-bold px-2 py-0.5 rounded">{{ $assignment->course_name }}</span>
                            <span class="text-xs text-slate-500 font-medium">• {{ $assignment->due_date->format('h:i A') }}</span>
                        </div>
                        <h3 class="font-bold text-slate-800 text-lg">{{ $assignment->title }}</h3>
                        <p class="text-slate-500 text-sm mt-1">{{ Str::limit($assignment->description, 100) }}</p>
                    </div>
                    <div class="flex items-center gap-3 w-full md:w-auto">
                        <button wire:click="showDetails({{ $assignment->id }})" class="flex-1 md:flex-none bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-bold px-4 py-2 rounded-xl text-sm transition">
                            Details
                        </button>
                        <button class="flex-1 md:flex-none bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-4 py-2 rounded-xl text-sm shadow-md shadow-indigo-200 transition">
                            Submit
                        </button>
                    </div>
                </div>
                @empty
                <div class="text-center py-12 bg-white rounded-2xl border border-slate-200 border-dashed">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">No Assignments Yet</h3>
                    <p class="text-slate-500">You're all caught up! or maybe you haven't added any yet.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Details Modal -->
    @if($selectedAssignment)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex justify-between items-start">
                <div>
                    <h3 class="text-xl font-bold text-slate-800">{{ $selectedAssignment->title }}</h3>
                    <p class="text-slate-500 text-sm mt-1">{{ $selectedAssignment->course_name }}</p>
                </div>
                <button wire:click="closeDetails" class="text-slate-400 hover:text-slate-600 transition">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                    <div>
                        <div class="text-xs text-slate-500 font-bold uppercase">Due Date</div>
                        <div class="font-semibold text-slate-800">{{ $selectedAssignment->due_date->format('F j, Y \a\t g:i A') }}</div>
                    </div>
                </div>
                
                <div>
                    <div class="text-xs text-slate-500 font-bold uppercase mb-2">Description</div>
                    <div class="text-slate-600 leading-relaxed bg-slate-50 p-4 rounded-xl border border-slate-100">
                        {{ $selectedAssignment->description }}
                    </div>
                </div>

                @if($selectedAssignment->status !== 'completed')
                <div class="border-t border-slate-100 pt-4 mt-4">
                    <h4 class="text-sm font-bold text-slate-800 mb-3">Submit Work</h4>
                    <form wire:submit.prevent="submitAssignment" class="space-y-4">
                        <div>
                            <textarea wire:model="submission_text" placeholder="Type your answer here..." rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-2 focus:border-indigo-500 focus:ring-indigo-500 text-sm"></textarea>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <div class="flex-1">
                                <label class="block w-full cursor-pointer">
                                    <span class="sr-only">Choose file</span>
                                    <input type="file" wire:model="submission_file" class="block w-full text-sm text-slate-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-xl file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-indigo-50 file:text-indigo-700
                                        hover:file:bg-indigo-100
                                    "/>
                                </label>
                            </div>
                        </div>

                        @error('submission') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                        @error('submission_text') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                        @error('submission_file') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror

                        <div class="flex items-center gap-3 pt-2">
                            <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-4 py-2.5 rounded-xl shadow-lg shadow-indigo-200 transition flex items-center justify-center gap-2">
                                <svg wire:loading.remove wire:target="submitAssignment" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <svg wire:loading wire:target="submitAssignment" class="animate-spin w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                <span>Submit Assignment</span>
                            </button>
                            <button type="button" wire:click="closeDetails" class="px-6 py-2.5 font-bold text-slate-600 hover:bg-slate-50 rounded-xl transition">
                                Close
                            </button>
                        </div>
                    </form>
                </div>
                @else
                <div class="bg-green-50 border border-green-100 rounded-xl p-4 mt-4 text-center">
                    <div class="flex items-center justify-center gap-2 text-green-700 font-bold mb-1">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Assignment Submitted
                    </div>
                    <p class="text-green-600 text-sm">You have successfully submitted this assignment.</p>
                </div>
                <div class="flex justify-end pt-4">
                    <button wire:click="closeDetails" class="px-6 py-2.5 font-bold text-slate-600 hover:bg-slate-50 rounded-xl transition">
                        Close
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>