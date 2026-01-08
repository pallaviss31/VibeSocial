<div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-bold text-slate-800">Online Classmates</h3>
        <div class="flex gap-2 text-slate-400">
            <svg class="w-4 h-4 cursor-pointer hover:text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
        </div>
    </div>

    <div class="space-y-3">
        @foreach($users as $user)
            <a href="{{ route('profile', $user->id) }}" class="flex items-center gap-3 group">
                <div class="relative">
                    <div class="w-10 h-10 rounded-full bg-indigo-50 border border-indigo-100 overflow-hidden">
                        <img src="@if ($user->dp) {{ asset('storage/images/dp/' . $user->dp) }} @else {{ asset('storage/dp.jpg') }} @endif" class="w-full h-full object-cover">
                    </div>
                    <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></span>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="font-semibold text-sm text-slate-700 group-hover:text-indigo-600 transition truncate">{{ $user->fname }} {{ $user->lname }}</div>
                    <div class="text-xs text-slate-400 truncate">Computer Science</div>
                </div>
            </a>
        @endforeach
    </div>
</div>