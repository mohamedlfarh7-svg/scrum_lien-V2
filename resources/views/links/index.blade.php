<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linker - My Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .glass-header {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .table-container {
            background: rgba(15, 23, 42, 0.6);
        }
    </style>
</head>
<body class="bg-[#0b101a] text-slate-200 p-4 md:p-10 font-sans antialiased">

    <div class="max-w-6xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-center mb-10 glass-header p-8 rounded-3xl shadow-2xl gap-6">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 bg-indigo-600/20 text-indigo-400 rounded-2xl flex items-center justify-center border border-indigo-500/30 shadow-inner">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                </div>
                <div>
                    <h1 class="text-3xl font-black text-white tracking-tight">My Library</h1>
                    <p class="text-slate-400 text-sm font-medium uppercase tracking-widest">{{ $links->count() }} Total Bookmarks</p>
                </div>
            </div>
            <div class="flex items-center gap-3 w-full md:w-auto">
                <a href="{{ route('dashboard') }}" class="flex-1 md:flex-none text-center px-6 py-3 bg-slate-800 hover:bg-slate-700 text-slate-300 rounded-xl font-bold transition border border-slate-700">
                    Dashboard
                </a>
                <a href="{{ route('links.create') }}" class="flex-1 md:flex-none text-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white rounded-xl font-bold transition shadow-xl shadow-indigo-500/20 active:scale-95">
                    + Add New
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 p-4 mb-8 rounded-2xl flex items-center gap-3 animate-pulse">
                <div class="bg-emerald-500 rounded-full p-1"><svg class="w-3 h-3 text-emerald-950" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg></div>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        <div class="table-container rounded-3xl border border-slate-800/50 shadow-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-separate border-spacing-0">
                    <thead>
                        <tr class="bg-slate-900/80">
                            <th class="px-8 py-5 text-xs font-black text-slate-500 uppercase tracking-[0.2em]">Link Information</th>
                            <th class="px-8 py-5 text-xs font-black text-slate-500 uppercase tracking-[0.2em]">Category</th>
                            <th class="px-8 py-5 text-xs font-black text-slate-500 uppercase tracking-[0.2em]">Tags</th>
                            <th class="px-8 py-5 text-xs font-black text-slate-500 uppercase tracking-[0.2em] text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/50">
                        @forelse ($links as $link)
                        <tr class="hover:bg-indigo-500/[0.03] transition-all group">
                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="text-lg font-bold text-white group-hover:text-indigo-400 transition-colors">{{ $link->title }}</span>
                                    <a href="{{ $link->url }}" target="_blank" class="text-slate-500 hover:text-cyan-400 text-sm mt-1 flex items-center gap-1.5 transition-colors italic">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                        {{ Str::limit($link->url, 40) }}
                                    </a>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-tighter bg-slate-800 text-slate-400 border border-slate-700 shadow-sm">
                                    {{ $link->category->name ?? 'Uncategorized' }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-wrap gap-2">
                                    @foreach($link->tags as $tag)
                                        <span class="px-2 py-1 bg-indigo-500/10 text-indigo-400 text-[10px] font-bold rounded-md border border-indigo-500/20">
                                            #{{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('links.edit', $link->id) }}" class="p-2.5 bg-slate-800 hover:bg-amber-500/20 text-slate-400 hover:text-amber-400 rounded-xl transition-all border border-slate-700" title="Edit Link">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('links.destroy', $link->id) }}" method="POST" onsubmit="return confirm('Delete this permanent link?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2.5 bg-slate-800 hover:bg-red-500/20 text-slate-400 hover:text-red-400 rounded-xl transition-all border border-slate-700" title="Delete Link">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <div class="bg-slate-900/50 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 border border-slate-800">
                                    <svg class="w-10 h-10 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                </div>
                                <h3 class="text-xl font-bold text-slate-400">No links stored yet</h3>
                                <p class="text-slate-600 mt-1">Your digital collection starts with a single URL.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
