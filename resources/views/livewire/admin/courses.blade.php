<div class="p-6 max-w-7xl mx-auto">
    
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
             class="fixed bottom-5 right-5 bg-slate-900 text-white px-5 py-3 rounded-lg shadow-xl flex items-center gap-3">
            <span class="text-xs font-bold">{{ session('success') }}</span>
        </div>
    @endif

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Courses</h1>
            <p class="text-sm text-slate-500">Manage your curriculum and student enrollment.</p>
        </div>
        <button wire:click="$toggle('showForm')" 
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-all">
            {{ $showForm ? 'Cancel' : '+ New Course' }}
        </button>
    </div>

    <div class="flex gap-4 mb-8">
        <div class="bg-slate-50 border border-slate-100 px-4 py-2 rounded-lg">
            <span class="text-[10px] uppercase font-bold text-slate-400 block">Total</span>
            <span class="text-lg font-bold text-slate-700">{{ $totalCourses }}</span>
        </div>
        <div class="bg-slate-50 border border-slate-100 px-4 py-2 rounded-lg">
            <span class="text-[10px] uppercase font-bold text-slate-400 block">Enrolled</span>
            <span class="text-lg font-bold text-indigo-600">{{ number_format($totalEnrollments) }}</span>
        </div>
    </div>

    @if($showForm)
    <div class="bg-white border border-slate-200 rounded-xl p-6 mb-8 shadow-sm">
        <form wire:submit.prevent="createCourse" class="space-y-4">
            <div>
                <label class="text-xs font-bold text-slate-500 uppercase">Title</label>
                <input type="text" wire:model="title" class="w-full mt-1 bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-sm outline-none focus:border-indigo-500">
                @error('title') <span class="text-rose-500 text-[10px]">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="text-xs font-bold text-slate-500 uppercase">Description</label>
                <textarea wire:model="description" class="w-full mt-1 bg-slate-50 border border-slate-200 rounded-lg px-4 py-2 text-sm outline-none focus:border-indigo-500" rows="3"></textarea>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-slate-800 text-white px-5 py-2 rounded-lg text-xs font-bold hover:bg-slate-900">Save Course</button>
            </div>
        </form>
    </div>
    @endif

    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4 font-semibold text-slate-600">Course Name</th>
                    <th class="px-6 py-4 font-semibold text-slate-600">Status</th>
                    <th class="px-6 py-4 font-semibold text-slate-600 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($courses as $course)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-800">{{ $course->title }}</div>
                        <div class="text-[11px] text-slate-400 italic">Added {{ $course->created_at?->format('M d, Y') ?? 'N/A' }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded text-[10px] font-bold uppercase tracking-wider">Active</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button wire:click="deleteCourse({{ $course->id }})" wire:confirm="Delete this course?" class="text-slate-400 hover:text-rose-600 transition-colors">
                            <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-10 text-center text-slate-400 text-xs uppercase font-bold tracking-widest">No courses found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>