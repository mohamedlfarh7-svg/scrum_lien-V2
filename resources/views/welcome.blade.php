<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Linker - Central Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .glass-header {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        .main-card {
            background: linear-gradient(145deg, rgba(30, 41, 59, 0.4), rgba(15, 23, 42, 0.7));
            border: 1px solid rgba(255, 255, 255, 0.03);
        }
        .action-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .action-card:hover {
            transform: translateY(-8px);
            background: rgba(255, 255, 255, 0.03);
            border-color: currentColor;
        }
    </style>
</head>
<body class="bg-[#0b101a] text-slate-200 font-sans antialiased overflow-x-hidden">

    <div class="fixed inset-0 z-0">
        <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-indigo-600/10 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] bg-blue-600/10 rounded-full blur-[120px]"></div>
    </div>

    <div class="relative z-10 min-h-screen flex flex-col">
        

        <nav class="glass-header sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex items-center">
                        <span class="text-3xl font-black bg-gradient-to-r from-indigo-400 via-cyan-400 to-blue-500 bg-clip-text text-transparent tracking-tighter">
                            Linker.
                        </span>
                    </div>

                    <div class="flex items-center gap-6">
                        @auth
                            <div class="flex items-center gap-3 bg-slate-900/50 px-4 py-2 rounded-2xl border border-slate-800">
                                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                                <span class="text-sm font-bold text-slate-300">{{ Auth::user()->name }}</span>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-sm font-black uppercase tracking-widest text-red-400 hover:text-red-300 transition-colors">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-bold text-slate-400 hover:text-white transition">Log in</a>
                            <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-2.5 rounded-xl font-bold transition shadow-lg shadow-indigo-600/20 text-sm">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-1 py-16 px-6">
            <div class="max-w-7xl mx-auto">

                <div class="mb-16 text-center md:text-left">
                    <h2 class="text-5xl md:text-6xl font-black text-white tracking-tight leading-tight">
                        Your Digital <span class="text-indigo-500">Universe</span>,<br>Organized.
                    </h2>
                    <p class="text-slate-400 mt-6 text-xl max-w-2xl leading-relaxed">
                        Welcome to the central hub. Manage your links, categories, and tags with a precision-engineered experience.
                    </p>
                </div>

                <div class="main-card rounded-[3rem] p-10 md:p-16 shadow-2xl backdrop-blur-xl">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                        <a href="{{ route('links.create') }}" class="action-card p-8 bg-slate-900/40 rounded-[2rem] border border-slate-800 flex flex-col items-center text-center text-blue-500">
                            <div class="w-16 h-16 bg-blue-500/10 rounded-2xl flex items-center justify-center mb-6 shadow-inner">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            </div>
                            <h3 class="text-2xl font-black text-white mb-3 tracking-tight">Add New Link</h3>
                            <p class="text-slate-400 text-sm leading-relaxed">Capture any URL and store it in your library instantly with custom metadata.</p>
                            <span class="mt-6 text-sm font-bold uppercase tracking-widest text-blue-400 group-hover:gap-3 transition-all">Quick Access &rarr;</span>
                        </a>

                        <a href="{{ route('categories.index') }}" class="action-card p-8 bg-slate-900/40 rounded-[2rem] border border-slate-800 flex flex-col items-center text-center text-emerald-500">
                            <div class="w-16 h-16 bg-emerald-500/10 rounded-2xl flex items-center justify-center mb-6 shadow-inner">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                            </div>
                            <h3 class="text-2xl font-black text-white mb-3 tracking-tight">Categories</h3>
                            <p class="text-slate-400 text-sm leading-relaxed">Structural organization for your bookmarks. Group by work, personal, or dev tools.</p>
                            <span class="mt-6 text-sm font-bold uppercase tracking-widest text-emerald-400">View Folder &rarr;</span>
                        </a>

                        <a href="{{ route('tags.index') }}" class="action-card p-8 bg-slate-900/40 rounded-[2rem] border border-slate-800 flex flex-col items-center text-center text-purple-500">
                            <div class="w-16 h-16 bg-purple-500/10 rounded-2xl flex items-center justify-center mb-6 shadow-inner">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            </div>
                            <h3 class="text-2xl font-black text-white mb-3 tracking-tight">Manage Tags</h3>
                            <p class="text-slate-400 text-sm leading-relaxed">The ultimate filtering tool. Use #hashtags to find specific resources in seconds.</p>
                            <span class="mt-6 text-sm font-bold uppercase tracking-widest text-purple-400">Explore Tags &rarr;</span>
                        </a>

                    </div>

                    @guest
                    <div class="mt-16 p-8 bg-indigo-500/5 border border-indigo-500/20 rounded-[2rem] text-center">
                        <p class="text-indigo-300 font-medium">
                            <span class="bg-indigo-500 text-white px-2 py-0.5 rounded text-xs font-black mr-2 uppercase">Pro Tip</span>
                            You need to <a href="{{ route('login') }}" class="text-white underline font-bold hover:text-indigo-400 transition">Log in</a> to save and sync your digital assets.
                        </p>
                    </div>
                    @endguest
                </div>
            </div>
        </main>

        <footer class="py-10 text-center text-slate-600 text-sm font-medium tracking-widest uppercase">
            &copy; {{ date('Y') }} Linker System. Built for speed.
        </footer>
    </div>
</body>
</html>
