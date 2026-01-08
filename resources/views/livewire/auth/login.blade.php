<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vibe Social Login</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Custom Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        cursive: ["Dancing Script", "cursive"],
                    }
                }
            }
        };
    </script>

    <!-- Custom Animations -->
    <style>
        /* Slide from Right */
        @keyframes slideFromRight {
            0% { opacity: 0; transform: translateX(120px); }
            100% { opacity: 1; transform: translateX(0); }
        }
        .animate-slideFromRight {
            animation: slideFromRight 1s ease-out forwards;
        }

       
    </style>

</head>

<body class="bg-gradient-to-br from-indigo-100 via-blue-50 to-slate-100">

<div class="min-h-screen flex">

    <!-- LEFT PANEL -->
    <div class="hidden lg:flex w-1/2 relative items-center justify-center overflow-hidden animate-fadeZoom">

        <!-- Floating Bubbles -->
        <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-indigo-400/20 rounded-full blur-3xl"></div>
        <div class="absolute top-10 -right-10 w-40 h-40 bg-indigo-600/30 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 w-24 h-24 bg-white/10 rounded-full blur-2xl"></div>

        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/90 to-slate-900/90 z-10"></div>

        <!-- Background Image -->
        <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?auto=format&fit=crop&w=1600&q=80"
             class="absolute w-full h-full object-cover">

        <!-- Content -->
        <div class="relative z-20 text-white max-w-xl p-14">

            <!-- Logo Box -->
            <div class="w-48 h-16 bg-white/10 backdrop-blur-xl rounded-2xl flex items-center justify-center mb-10 border border-white/20 shadow-xl">
                <span class="text-4xl font-extrabold font-cursive text-white drop-shadow-xl">
                    Vibe Social
                </span>
            </div>

            <h1 class="text-5xl font-extrabold leading-tight mb-5 drop-shadow-lg">
                Your Digital Campus, Connected.
            </h1>

            <p class="text-lg text-indigo-200 leading-relaxed">
                Collaborate on assignments, message your classmates, share notes, and build your academic network — all in one place.
            </p>

            <div class="mt-12 flex gap-4">
                <div class="flex -space-x-4">
                    <img class="w-11 h-11 rounded-full border-2 border-white/40"
                         src="https://ui-avatars.com/api/?name=Alex+M&background=random">

                    <img class="w-11 h-11 rounded-full border-2 border-white/40"
                         src="https://ui-avatars.com/api/?name=Sarah+J&background=random">

                    <img class="w-11 h-11 rounded-full border-2 border-white/40"
                         src="https://ui-avatars.com/api/?name=Mike+T&background=random">
                </div>

                <p class="flex items-center text-base font-medium text-indigo-100">
                    ⭐ Trusted by 5,000+ students
                </p>
            </div>

        </div>
    </div>

    <!-- RIGHT PANEL (LOGIN FORM) -->

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-16 bg-slate-50 animate-slideFromRight">
        <div class="w-full max-w-md space-y-8">
            <div class="text-center lg:text-left">
                <h2 class="text-3xl font-bold text-slate-900">Student Login</h2>
                <p class="mt-2 text-slate-600">Please enter your credentials to access the portal.</p>
            </div>

            <form wire:submit.prevent="login" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Student Email or ID</label>
                    <div class="relative">
                        <input type="email" id="email" wire:model="email" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all pl-11" placeholder="student@university.edu">
                        <svg class="w-5 h-5 text-slate-400 absolute left-3.5 top-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                        <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                    </div>
                    <div class="relative">
                        <input type="password" id="password" wire:model="password" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all pl-11" placeholder="••••••••">
                        <svg class="w-5 h-5 text-slate-400 absolute left-3.5 top-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    @error('password') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white py-3.5 rounded-xl font-bold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all shadow-lg shadow-indigo-200">
                    Access Portal
                </button>
            </form>

            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-slate-50 text-slate-500">New to campus?</span>
                </div>
            </div>

            <div class="text-center">
                <a href="{{route('register')}}" class="inline-flex items-center justify-center w-full px-4 py-3 border-2 border-slate-200 rounded-xl text-sm font-bold text-slate-700 bg-white hover:bg-slate-50 hover:border-slate-300 transition-all">
                    Activate Student Account
                </a>
            </div>
        </div>
    </div>

</div>

</body>
</html>
