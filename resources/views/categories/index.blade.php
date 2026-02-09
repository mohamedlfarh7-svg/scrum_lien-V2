<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linker - Manage Categories</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .glass-card {
            background: linear-gradient(145deg, rgba(30, 41, 59, 0.4), rgba(15, 23, 42, 0.7));
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.03);
        }
        .emerald-glow:focus {
            box-shadow: 0 0 20px -5px rgba(16, 185, 129, 0.2);
        }
    </style>
</head>
<body class="bg-[#0b101a] text-slate-200 p-4 md:p-10 font-sans antialiased overflow-x-hidden">

    <div class="max-w-4xl mx-auto">

        <div class="mb-12">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-emerald-400 transition-colors mb-6 group">
                <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back to Dashboard
            </a>
            
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <h1 class="text-4xl font-black text-white tracking-tight">Categories</h1>
                    <p class="text-slate-400 mt-2">Organize your digital library by topics.</p>
                </div>

                <form action="{{ route('categories.store') }}" method="POST" class="flex items-center gap-2 bg-slate-900/50 p-2 rounded-2xl border border-slate-800 w-full md:w-auto">
                    @csrf
                    <input type="text" name="name" required 
                        class="bg-transparent border-none rounded-xl px-4 py-2 text-white focus:ring-0 w-full placeholder-slate-600 text-sm"
                        placeholder="New category...">
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2 px-6 rounded-xl transition shadow-lg shadow-emerald-600/20 active:scale-95 text-sm whitespace-nowrap">
                        Add
                    </button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 p-4 mb-8 rounded-2xl flex items-center gap-3">
                <div class="bg-emerald-500 rounded-full p-1"><svg class="w-3 h-3 text-emerald-950" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg></div>
                <span class="font-bold text-sm">{{ session('success') }}</span>
            </div>
        @endif

        <div class="glass-card rounded-3xl overflow-hidden border border-slate-800/50 shadow-2xl">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-900/80 border-b border-slate-800/50">
                        <th class="px-8 py-5 text-xs font-black text-slate-500 uppercase tracking-[0.2em]">Label</th>
                        <th class="px-8 py-5 text-xs font-black text-slate-500 uppercase tracking-[0.2em]">Resources</th>
                        <th class="px-8 py-5 text-xs font-black text-slate-500 uppercase tracking-[0.2em] text-right">Management</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/50">
                    @forelse ($categories as $category)
                    <tr class="hover:bg-emerald-500/[0.02] transition-all group">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 flex items-center justify-center border border-emerald-500/20 text-emerald-400 font-black group-hover:scale-110 transition-transform">
                                    {{ substr($category->name, 0, 1) }}
                                </div>
                                <span class="font-bold text-white text-lg group-hover:text-emerald-400 transition-colors tracking-tight">
                                    {{ $category->name }}
                                </span>
                            </div>
                        </td>
                        <td class="px-8 py-6 text-sm font-medium text-slate-400">
                            <span class="bg-slate-800 px-3 py-1 rounded-lg border border-slate-700">
                                {{ $category->links_count ?? $category->links->count() }} links
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('categories.edit', $category->id) }}" class="p-2.5 bg-slate-800/50 hover:bg-amber-500/20 text-slate-400 hover:text-amber-400 rounded-xl transition-all border border-slate-700" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Deleting this category will affect links. Continue?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2.5 bg-slate-800/50 hover:bg-red-500/20 text-slate-400 hover:text-red-400 rounded-xl transition-all border border-slate-700" title="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-8 py-20 text-center">
                            <div class="bg-slate-900/50 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 border border-slate-800">
                                <svg class="w-10 h-10 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/></svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-400">Clean Slate</h3>
                            <p class="text-slate-600 mt-1 text-sm">Organize your world by adding a category above.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
