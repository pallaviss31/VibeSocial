<div class="max-w-3xl mx-auto py-10">
    <div class="bg-white shadow rounded-xl p-6">

        <h2 class="text-2xl font-bold mb-6 text-gray-800">
            Create New Quiz
        </h2>

        <form wire:submit.prevent="save" class="space-y-4">

            <input wire:model="title" type="text" placeholder="Quiz Title" class="w-full border rounded px-4 py-2">

            <textarea wire:model="description" placeholder="Description (optional)" class="w-full border rounded px-4 py-2"></textarea>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <!-- Total Questions -->
                <div class="relative">
                    <label class="block text-xs font-semibold text-slate-500 mb-1">
                        Total Questions
                    </label>
                    <input wire:model="total_questions" type="number" min="1" placeholder="e.g. 10"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm
                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                   transition">
                </div>

                <!-- Passing Marks -->
                <div class="relative">
                    <label class="block text-xs font-semibold text-slate-500 mb-1">
                        Passing Marks
                    </label>
                    <input wire:model="passing_marks" type="number" min="1" placeholder="e.g. 5"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm
                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                   transition">
                </div>

                <!-- Time Limit -->
                <div class="relative">
                    <label class="block text-xs font-semibold text-slate-500 mb-1">
                        Time Limit (minutes)
                    </label>
                    <input type="number" min="1" wire:model.defer="time_limit" placeholder="e.g. 15"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm
                   focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                   transition">
                    <p class="text-[11px] text-slate-400 mt-1">
                        Auto-submit after time ends
                    </p>
                </div>

            </div>


            <div class="grid grid-cols-3 gap-4">
                <input wire:model="course" placeholder="Course" class="border px-3 py-2 rounded">
                <input wire:model="semester" placeholder="Semester" class="border px-3 py-2 rounded">
                <input wire:model="subject" placeholder="Subject" class="border px-3 py-2 rounded">
            </div>

            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded">
                Save & Add Questions
            </button>
        </form>
    </div>
</div>
