<div class="max-w-7xl mx-auto px-6 py-8 space-y-6">

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Quizzes
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Manage all quizzes created by admins and users
            </p>
        </div>

        <button wire:click="$toggle('showCreateModal')"
            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl font-medium shadow transition
        {{ $showCreateModal
            ? 'bg-gray-200 text-gray-700 hover:bg-gray-300'
            : 'bg-indigo-600 text-white hover:bg-indigo-700' }}">
            @if ($showCreateModal)
                <!-- Cancel Icon -->
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Cancel
            @else
                <!-- Plus Icon -->
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Create Quiz
            @endif
        </button>

    </div>

    <!-- Create Quiz Section -->
    @if ($showCreateModal)
        <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-6 shadow-sm">
            <livewire:quiz.create-quiz />
        </div>
    @endif

    <!-- Quiz Table -->
    <div class="bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-100">

        <table class="w-full border-collapse">
            <thead class="bg-gray-50 text-sm text-gray-600 uppercase tracking-wide">
                <tr>
                    <th class="text-left px-5 py-4">Title</th>
                    <th class="text-left px-5 py-4">Creator</th>
                    <th class="text-left px-5 py-4">Status</th>
                    <th class="text-right px-5 py-4">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">

                @forelse ($quizzes as $quiz)
                    <tr class="hover:bg-gray-50 transition">

                        <!-- Title -->
                        <td class="px-5 py-4">
                            <div class="font-semibold text-gray-800">
                                {{ $quiz->title }}
                            </div>
                            <div class="text-xs text-gray-500 mt-0.5">
                                {{ $quiz->subject ?? 'General' }}
                            </div>
                        </td>

                        <!-- Creator -->
                        <td class="px-5 py-4">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                {{ $quiz->creator_role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ ucfirst($quiz->creator_role) }}
                            </span>
                        </td>

                        <!-- Status -->
                        <td class="px-5 py-4">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                @if ($quiz->status === 'approved') bg-green-100 text-green-700
                                @elseif ($quiz->status === 'pending') bg-yellow-100 text-yellow-700
                                @else bg-red-100 text-red-700 @endif">
                                {{ ucfirst($quiz->status) }}
                            </span>
                        </td>

                        <!-- Actions -->
                        <td class="px-5 py-4 text-right space-x-2">

                            <a href="{{ route('quiz.review', $quiz->id) }}"
                                class="inline-block px-4 py-1.5 text-sm rounded-lg bg-gray-800 text-white hover:bg-gray-900 transition">
                                Questions
                            </a>

                            @if ($quiz->status === 'pending')
                                <button wire:click="approve({{ $quiz->id }})"
                                    class="inline-block px-3 py-1.5 text-sm rounded-lg bg-green-600 text-white hover:bg-green-700 transition">
                                    Approve
                                </button>

                                <button wire:click="reject({{ $quiz->id }})"
                                    class="inline-block px-3 py-1.5 text-sm rounded-lg bg-red-600 text-white hover:bg-red-700 transition">
                                    Reject
                                </button>
                            @endif

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-10 text-gray-500">
                            No quizzes found.
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>

    </div>
</div>
