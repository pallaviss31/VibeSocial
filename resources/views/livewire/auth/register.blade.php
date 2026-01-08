<div class="min-h-screen flex bg-white">
    <!-- Left Side: Campus Image -->
    <div class="hidden lg:flex w-1/2 bg-indigo-900 relative items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/90 to-slate-900/90 z-10"></div>
        <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80" alt="Library" class="absolute inset-0 w-full h-full object-cover">
        
        <div class="relative z-20 text-white p-12 max-w-xl">
            <h1 class="text-4xl font-bold mb-6 leading-tight">Join the Community</h1>
            <ul class="space-y-6 text-lg text-indigo-100">
                <li class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    </div>
                    <span>Access course materials and notes</span>
                </li>
                <li class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <span>Find study partners and groups</span>
                </li>
                <li class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                    <span>Keep track of deadlines and events</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Right Side: Register Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-16 bg-slate-50 overflow-y-auto">
        <div class="w-full max-w-md space-y-8">
            <div class="text-center lg:text-left">
                <h2 class="text-3xl font-bold text-slate-900">Activate Account</h2>
                <p class="mt-2 text-slate-600">Create your student profile to get started.</p>
            </div>

            <form wire:submit.prevent="register" class="space-y-5">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="fname" class="block text-sm font-medium text-slate-700 mb-1">First Name</label>
                        <input type="text" id="fname" wire:model="fname" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" placeholder="John">
                        @error('fname') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="lname" class="block text-sm font-medium text-slate-700 mb-1">Last Name</label>
                        <input type="text" id="lname" wire:model="lname" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" placeholder="Doe">
                        @error('lname') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Student Email</label>
                    <input type="email" id="email" wire:model="email" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" placeholder="john.doe@university.edu">
                    @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-slate-700 mb-1">Mobile Number</label>
                    <input type="text" id="phone" wire:model="phone" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" placeholder="+1 (555) 000-0000">
                    @error('phone') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="dob" class="block text-sm font-medium text-slate-700 mb-1">Date of Birth</label>
                        <input type="date" id="dob" wire:model="dob" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                        @error('dob') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="gender" class="block text-sm font-medium text-slate-700 mb-1">Gender</label>
                        <select id="gender" wire:model="gender" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all">
                            <option value="">Select...</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        @error('gender') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Create Password</label>
                    <input type="password" id="password" wire:model="password" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all" placeholder="••••••••">
                    @error('password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="text-xs text-slate-500">
                    By clicking Sign Up, you agree to our <a href="#" class="text-indigo-600 hover:underline">Terms</a>, <a href="#" class="text-indigo-600 hover:underline">Privacy Policy</a> and <a href="#" class="text-indigo-600 hover:underline">Cookies Policy</a>.
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white py-3.5 rounded-xl font-bold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all shadow-lg shadow-indigo-200">
                    Sign Up
                </button>
            </form>

            <div class="text-center">
                <p class="text-sm text-slate-600">
                    Already have an account? <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:text-indigo-500">Log In</a>
                </p>
            </div>
        </div>
    </div>
</div>