<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        cursive: ["Dancing Script", "cursive"],
                    }
                }
            }
        }
    </script>
    @livewireStyles


    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- ✅ IMPORTANT — YOU FORGOT THIS -->
</head>

<body class="bg-slate-50 min-h-screen text-slate-900 overflow-y-scroll">
    <!-- Fixed Header -->
    <header
        class="bg-white border-b border-slate-200 fixed top-0 w-full z-50 h-16 flex items-center justify-between px-4 lg:px-8">
        <!-- Left: Logo & Search -->
        <div class="flex items-center gap-8 w-1/3">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                <div
                    class="w-10 h-10 bg-indigo-400 rounded-lg flex items-center justify-center text-pink-400 font-bold text-xl shadow-lg shadow-indigo-200 group-hover:scale-105 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path
                            d="M2 4.25A2.25 2.25 0 0 1 4.25 2h2.5A2.25 2.25 0 0 1 9 4.25v2.5A2.25 2.25 0 0 1 6.75 9h-2.5A2.25 2.25 0 0 1 2 6.75v-2.5ZM2 13.25A2.25 2.25 0 0 1 4.25 11h2.5A2.25 2.25 0 0 1 9 13.25v2.5A2.25 2.25 0 0 1 6.75 18h-2.5A2.25 2.25 0 0 1 2 15.75v-2.5ZM11 4.25A2.25 2.25 0 0 1 13.25 2h2.5A2.25 2.25 0 0 1 18 4.25v2.5A2.25 2.25 0 0 1 15.75 9h-2.5A2.25 2.25 0 0 1 11 6.75v-2.5ZM15.25 11.75a.75.75 0 0 0-1.5 0v2h-2a.75.75 0 0 0 0 1.5h2v2a.75.75 0 0 0 1.5 0v-2h2a.75.75 0 0 0 0-1.5h-2v-2Z" />
                    </svg>




                </div>
                <div class="font-extrabold">
                    <h1 class=" text-3xl font-cursive text-indigo-600  hidden md:block">Vibe<span
                            class="text-pink-600">Social</span></h1>
                    {{-- <img src="{{asset('storage/images/vibe.png')}}" class="w-20 h-20 oject-cover"> --}}
                </div>
            </a>
            <div class="relative hidden lg:block w-full max-w-md">
                <form action="{{ route('find.friends') }}" method="get">
                    <input type="text" name="query" placeholder="Search for classmates, courses, or events..."
                        class="bg-slate-100 border-none px-4 py-2.5 rounded-xl pl-11 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 w-full text-sm font-medium transition-all hover:bg-slate-200/50 focus:bg-white"
                        autocomplete="off">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-3.5 top-2.5 text-slate-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </form>
            </div>
        </div>

        <!-- Center: Navigation (Mobile/Tablet only, hidden on large desktop if sidebar handles it) -->
        <!-- Keeping minimal for now, focusing on sidebar for main nav -->

        <!-- Right: Profile & Menu -->
        <div class="flex items-center justify-end gap-4 w-1/3">
            {{-- Admin Mode Button --}}
            @auth
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('admin.index') }}"
                        class="hidden md:flex items-center gap-2 px-4 py-2
                  bg-gradient-to-r from-indigo-900 to-purple-900
                  text-white text-sm font-semibold rounded-xl
                  shadow-md hover:shadow-lg hover:scale-105
                  transition-all">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4m5-2a9 9 0 11-18 0
                             9 9 0 0118 0z" />
                        </svg>

                        Admin Mode
                    </a>
                @endif
            @endauth


            <button class="relative p-2 text-slate-500 hover:bg-slate-100 rounded-full transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span
                    class="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
            </button>

            <a href="{{ route('profile') }}" class="flex items-center gap-3 pl-2 border-l border-slate-200">
                <div class="text-right hidden md:block">
                    <div class="text-sm font-bold text-slate-800">{{ auth()->user()->name ?? 'Student' }}</div>
                    <div class="text-xs text-slate-500 font-medium">Computer Science</div>
                </div>
                <div class="w-10 h-10 rounded-full bg-indigo-100 border-2 border-white shadow-sm overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name ?? 'User' }}&background=random"
                        alt="Profile" class="w-full h-full object-cover">
                </div>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="p-2 text-slate-400 hover:text-red-500 transition" title="Logout">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>
    </header>
    <!-- Main Content -->
    <div class="pt-16 min-h-screen">
        {{ $slot }}
    </div>
    {{-- @livewireStyles --}}
    @livewireScripts

</body>

</html>
