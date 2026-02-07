<div class="p-6 max-w-7xl mx-auto">
    
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Scholar Management</h1>
            <p class="text-sm text-slate-500">Overview of student engagement and roles.</p>
        </div>
        <div class="flex gap-2">
            <button class="px-4 py-2 text-sm font-semibold text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50">Export CSV</button>
            <button class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 shadow-sm">+ Add Student</button>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white border border-slate-200 p-4 rounded-xl shadow-sm">
            <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Total Scholars</span>
            <span class="text-xl font-bold text-slate-800">{{ count($users) }}</span>
        </div>
        <div class="bg-white border border-slate-200 p-4 rounded-xl shadow-sm">
            <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Active Now</span>
            <span class="text-xl font-bold text-emerald-600">12</span>
        </div>
        <div class="bg-white border border-slate-200 p-4 rounded-xl shadow-sm">
            <span class="text-[10px] uppercase font-bold text-slate-400 block tracking-wider">Flagged</span>
            <span class="text-xl font-bold text-rose-600">03</span>
        </div>
        <div class="bg-indigo-50 border border-indigo-100 p-4 rounded-xl">
            <span class="text-[10px] uppercase font-bold text-indigo-400 block tracking-wider">Avg Karma</span>
            <span class="text-xl font-bold text-indigo-700">4.8k</span>
        </div>
    </div>

    <div class="mb-4 relative">
        <input type="text" placeholder="Search by name or email..." 
               class="w-full md:w-96 bg-white border border-slate-200 rounded-lg py-2 pl-10 pr-4 text-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 outline-none transition-all">
        <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
    </div>

    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr class="text-slate-500 font-medium">
                    <th class="px-6 py-4">Scholar</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4 text-center">Karma</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($users as $user)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=e2e8f0&color=475569" class="w-8 h-8 rounded-lg">
                            <div>
                                <div class="font-bold text-slate-800">{{ $user->name }}</div>
                                <div class="text-[11px] text-slate-400">Joined {{ $user->created_at?->format('M Y') ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase border 
                            {{ $user->role === 'admin' ? 'bg-indigo-50 text-indigo-600 border-indigo-100' : 'bg-slate-50 text-slate-600 border-slate-100' }}">
                            {{ $user->role === 'admin' ? 'Faculty' : 'Scholar' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center font-semibold text-slate-700">
                        {{ number_format(rand(100, 5000)) }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-3 text-slate-400">
                            <button class="hover:text-indigo-600 transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </button>
                            <button class="hover:text-rose-600 transition-colors" title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-slate-400 italic">No scholars found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>