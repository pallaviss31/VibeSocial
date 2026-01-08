<div class="max-w-7xl mx-auto px-4 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Find Classmates</h2>
            <p class="text-slate-500">Connect with students from your campus</p>
        </div>
        <div class="flex gap-2">
            <select class="bg-white border border-slate-200 text-slate-700 text-sm rounded-xl px-3 py-2 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition">
                <option>All Majors</option>
                <option>Computer Science</option>
                <option>Business</option>
                <option>Arts</option>
            </select>
            <select class="bg-white border border-slate-200 text-slate-700 text-sm rounded-xl px-3 py-2 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition">
                <option>Class of '25</option>
                <option>Class of '26</option>
                <option>Class of '27</option>
            </select>
        </div>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        @foreach($users as $user)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden flex flex-col hover:shadow-md transition duration-300 group">
                <div class="relative aspect-square overflow-hidden cursor-pointer">
                    <a href="{{ route('profile', ['id' => $user->id]) }}">
                        <img src="@if ($user->dp) {{ asset('storage/images/dp/' . $user->dp) }} @else {{ asset('storage/dp.jpg') }} @endif"
                             alt="{{ $user->fname }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </a>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                
                <div class="p-4 flex flex-col flex-1">
                    <a href="{{ route('profile', ['id' => $user->id]) }}" class="font-bold text-slate-800 text-lg leading-tight mb-1 hover:text-indigo-600 transition truncate">
                        {{ $user->fname }} {{ $user->lname }}
                    </a>
                    <div class="text-xs text-slate-500 font-medium mb-3">Computer Science • '25</div>
                    
                    <!-- Mutual friends placeholder -->
                    <div class="text-xs text-slate-500 mb-4 flex items-center gap-2 bg-slate-50 p-2 rounded-lg">
                        @if(rand(0,1))
                            <div class="flex -space-x-2">
                                <img src="https://i.pravatar.cc/100?img={{ rand(1,10) }}" class="w-5 h-5 rounded-full border-2 border-white">
                                <img src="https://i.pravatar.cc/100?img={{ rand(11,20) }}" class="w-5 h-5 rounded-full border-2 border-white">
                            </div>
                            <span>{{ rand(1, 20) }} mutual connections</span>
                        @else
                            <svg class="w-4 h-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                            <span>Suggested for you</span>
                        @endif
                    </div>

                    <div class="mt-auto space-y-2">
                        @if($user->id != auth()->user()->id)
                            <div class="w-full">
                                <livewire:user.friendship-button :selectedUser="$user" :key="$user->id" />
                            </div>
                            <button class="w-full bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-800 font-semibold py-2 rounded-xl text-sm transition">
                                Remove
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>