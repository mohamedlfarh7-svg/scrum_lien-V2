<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linker - Tags Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .tag-card {
            background: linear-gradient(145deg, rgba(30, 41, 59, 0.4), rgba(15, 23, 42, 0.7));
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .tag-card:hover {
            transform: translateY(-4px);
            background: linear-gradient(145deg, rgba(126, 34, 206, 0.1), rgba(15, 23, 42, 0.8));
        }
    </style>
</head>
<body class="bg-[#0b101a] text-slate-200 p-4 md:p-10 font-sans antialiased overflow-x-hidden">

    <div class="max-w-5xl mx-auto">

        <div class="mb-12">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-purple-400 transition-colors mb-6 group">
                <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Dashboard
            </a>
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div>
                    <h1 class="text-4xl font-black text-white tracking-tight">Hashtags</h1>
                    <p class="text-slate-400 mt-2">Filter and find your links using keywords.</p>
                </div>

                <form action="{{ route('tags.store') }}" method="POST" class="relative group max-w-sm w-full">
                    @csrf
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-purple-500 font-black">#</div>
                    <input type="text" name="name" required 
                        class="w-full bg-slate-900/50 border border-slate-800 rounded-2xl pl-8 pr-24 py-4 text-white focus:outline-none focus:ring-2 focus:ring-purple-500/50 transition-all placeholder-slate-600"
                        placeholder="new-tag">
                    <button type="submit" class="absolute right-2 top-2 bottom-2 px-4 bg-purple-600 hover:bg-purple-500 text-white font-bold rounded-xl transition shadow-lg shadow-purple-600/20 text-xs uppercase tracking-widest">
                        Create
                    </button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-purple-500/10 border border-purple-500/20 text-purple-400 p-4 mb-8 rounded-2xl flex items-center gap-3 animate-in fade-in slide-in-from-top-4 duration-500">
                <div class="bg-purple-500 rounded-full p-1"><svg class="w-3 h-3 text-purple-950" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg></div>
                <span class="font-bold text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @forelse ($tags as $tag)
            <div class="tag-card group relative p-6 rounded-3xl border border-slate-800/50 shadow-xl overflow-hidden">

                <div class="absolute -right-2 -bottom-2 text-slate-800/20 font-black text-6xl select-none group-hover:text-purple-500/10 transition-colors">#</div>
                
                <div class="relative z-10">
                    <div class="flex items-start justify-between mb-4">
                        <span class="text-xl font-black text-white group-hover:text-purple-400 transition-colors truncate pr-8">
                            <span class="text-purple-600">#</span>{{ $tag->name }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between mt-8">
                        <div class="flex flex-col">
                            <span class="text-2xl font-black text-slate-200">{{ $tag->links->count() }}</span>
                            <span class="text-[10px] uppercase font-bold tracking-[0.2em] text-slate-500">Mentions</span>
                        </div>

                        <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-all transform translate-y-2 group-hover:translate-y-0">
                            <a href="{{ route('tags.edit', $tag->id) }}" class="p-2 bg-slate-800 hover:bg-amber-500/20 text-slate-400 hover:text-amber-400 rounded-lg transition-colors border border-slate-700/50">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                            <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" onsubmit="return confirm('Archive this tag?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-slate-800 hover:bg-red-500/20 text-slate-400 hover:text-red-400 rounded-lg transition-colors border border-slate-700/50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center glass-card rounded-3xl border border-dashed border-slate-800">
                <div class="w-16 h-16 bg-slate-900 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-700">#</div>
                <h3 class="text-xl font-bold text-slate-400">No tags found</h3>
                <p class="text-slate-600 mt-1">Start labeling your links to see them here.</p>
            </div>
            @endforelse
        </div>
    </div>

</body>
</html>
