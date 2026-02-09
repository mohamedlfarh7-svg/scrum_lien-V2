<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linker - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .glass-sidebar {
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(12px);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }
        .card-gradient {
            background: linear-gradient(145deg, rgba(30, 41, 59, 0.7), rgba(15, 23, 42, 0.8));
        }
    </style>
</head>
<body class="bg-[#0b101a] text-slate-200 font-sans antialiased overflow-x-hidden">

    <div class="flex min-h-screen">
        <aside class="w-64 glass-sidebar fixed inset-y-0 left-0 hidden md:flex flex-col z-50">
            <div class="p-8">
                <span class="text-3xl font-black bg-gradient-to-r from-indigo-400 via-cyan-400 to-emerald-400 bg-clip-text text-transparent">Linker.</span>
            </div>
            
            <nav class="flex-1 px-4 space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 bg-indigo-500/10 text-indigo-400 rounded-xl border border-indigo-500/20">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    Dashboard
                </a>
                <a href="{{ route('links.index') }}" class="flex items-center px-4 py-3 text-slate-400 hover:bg-slate-800/50 hover:text-white rounded-xl transition-all">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                    My Links
                </a>
                <a href="{{ route('categories.index') }}" class="flex items-center px-4 py-3 text-slate-400 hover:bg-slate-800/50 hover:text-white rounded-xl transition-all">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                    Categories
                </a>
            </nav>

            <div class="p-4 border-t border-slate-800/50">
                <div class="flex items-center p-3 bg-slate-900/50 rounded-2xl border border-slate-800">
                    <div class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center font-bold text-white shadow-lg">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="ml-3 overflow-hidden text-sm">
                        <p class="font-bold text-white truncate">{{ Auth::user()->name }}</p>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-xs text-red-400 hover:underline">Sign out</button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <main class="flex-1 md:ml-64 p-8">
            <header class="flex flex-col md:flex-row md:items-center justify-between mb-12 gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-white">Hello, {{ Auth::user()->name }}!</h1>
                    <p class="text-slate-400 mt-1">Here's what's happening with your links today.</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('links.create') }}" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl font-bold transition shadow-lg shadow-indigo-600/20 active:scale-95 text-center">
                        + New Link
                    </a>
                </div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="card-gradient p-6 rounded-3xl border border-slate-800 hover:border-indigo-500/30 transition group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-indigo-500/10 text-indigo-400 rounded-2xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                        </div>
                    </div>
                    <h3 class="text-slate-400 font-medium">Total Links</h3>
                    <p class="text-4xl font-black text-white mt-1">{{ $totalLinks }}</p>
                    <a href="{{ route('links.index') }}" class="mt-4 flex items-center text-sm text-indigo-400 font-bold group-hover:gap-2 transition-all">
                        View all <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                <div class="card-gradient p-6 rounded-3xl border border-slate-800 hover:border-emerald-500/30 transition group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-emerald-500/10 text-emerald-400 rounded-2xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                        </div>
                    </div>
                    <h3 class="text-slate-400 font-medium">Categories</h3>
                    <p class="text-4xl font-black text-white mt-1">{{ $totalCategories }}</p>
                    <a href="{{ route('categories.index') }}" class="mt-4 flex items-center text-sm text-emerald-400 font-bold group-hover:gap-2 transition-all">
                        Manage <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>

                <div class="card-gradient p-6 rounded-3xl border border-slate-800 hover:border-amber-500/30 transition group">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-amber-500/10 text-amber-400 rounded-2xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        </div>
                    </div>
                    <h3 class="text-slate-400 font-medium">Active Tags</h3>
                    <p class="text-4xl font-black text-white mt-1">{{ $totalTags }}</p>
                    <a href="{{ route('tags.index') }}" class="mt-4 flex items-center text-sm text-amber-400 font-bold group-hover:gap-2 transition-all">
                        Browse <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <div class="card-gradient border border-slate-800 rounded-3xl p-8">
                <h2 class="text-xl font-bold text-white mb-6">Recently Added</h2>
                <div class="space-y-4">
                    @forelse($recentLinks as $link)
                    <div class="flex items-center justify-between p-4 bg-slate-900/40 rounded-2xl border border-slate-800/50 hover:bg-slate-800/50 transition">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-slate-800 rounded-lg flex items-center justify-center mr-4">🌐</div>
                            <div>
                                <p class="text-white font-semibold">{{ $link->title }}</p>
                                <p class="text-xs text-slate-500">{{ Str::limit($link->url, 45) }}</p>
                            </div>
                        </div>
                        <span class="text-xs font-medium px-3 py-1 bg-slate-800 text-slate-400 rounded-full">
                            {{ $link->category->name ?? 'General' }}
                        </span>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <p class="text-slate-500 italic">No links added yet.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
</body>
</html>