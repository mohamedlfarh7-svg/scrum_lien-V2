<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linker - Create Bookmark</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .glass-panel {
            background: rgba(30, 41, 59, 0.4);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .input-glow:focus {
            box-shadow: 0 0 20px -5px rgba(99, 102, 241, 0.3);
        }
        /* Style للمربعات اختيار الـ Tags */
        option:checked {
            background: #6366f1 !important;
            color: white !important;
        }
    </style>
</head>
<body class="bg-[#0b101a] text-slate-200 min-h-screen font-sans antialiased flex items-center justify-center p-4">

    <div class="fixed inset-0 z-0">
        <div class="absolute top-[-10%] right-[-10%] w-[40%] h-[40%] bg-indigo-600/10 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[40%] h-[40%] bg-cyan-600/10 rounded-full blur-[120px]"></div>
    </div>

    <div class="relative z-10 w-full max-w-2xl">

        <div class="flex items-center justify-between mb-8 px-2">
            <a href="{{ route('links.index') }}" class="group flex items-center text-sm font-bold text-slate-500 hover:text-white transition-all">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back to Library
            </a>
            <span class="text-xs font-black uppercase tracking-[0.3em] text-indigo-500/60">Step 01 / New Link</span>
        </div>

        <div class="glass-panel rounded-[2.5rem] shadow-2xl p-8 md:p-12 overflow-hidden relative">

            <div class="absolute -top-6 -right-6 w-32 h-32 bg-indigo-600/5 rounded-full flex items-center justify-center rotate-12">
                <svg class="w-16 h-16 text-indigo-500/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            </div>

            <div class="relative z-10">
                <div class="mb-10">
                    <h1 class="text-4xl font-black text-white tracking-tight">Add Link</h1>
                    <p class="text-slate-400 mt-2">Store your digital assets with metadata.</p>
                </div>

                <form action="{{ route('links.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="md:col-span-2 group">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2 ml-1 group-focus-within:text-indigo-400 transition-colors">Resource Title</label>
                            <input type="text" name="title" required autofocus
                                class="w-full bg-slate-900/50 border border-slate-800 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-indigo-500/50 input-glow transition-all placeholder-slate-600"
                                placeholder="e.g. Tailwind CSS Documentation">
                        </div>

                        <div class="md:col-span-2 group">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2 ml-1 group-focus-within:text-indigo-400 transition-colors">Destination URL</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-5 flex items-center text-slate-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                </span>
                                <input type="url" name="url" required
                                    class="w-full bg-slate-900/50 border border-slate-800 rounded-2xl pl-12 pr-5 py-4 text-white focus:outline-none focus:border-indigo-500/50 input-glow transition-all placeholder-slate-600"
                                    placeholder="https://">
                            </div>
                        </div>

                        <div class="group">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2 ml-1 group-focus-within:text-indigo-400 transition-colors">Category</label>
                            <div class="relative">
                                <select name="category_id" class="w-full bg-slate-900/50 border border-slate-800 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-indigo-500/50 appearance-none cursor-pointer">
                                    <option value="" disabled selected>Select Folders</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        <div class="group">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2 ml-1 group-focus-within:text-indigo-400 transition-colors">Attach Tags</label>
                            <select name="tags[]" multiple 
                                class="w-full bg-slate-900/50 border border-slate-800 rounded-2xl px-4 py-2 text-white focus:outline-none focus:border-indigo-500/50 h-[60px] scrollbar-hide cursor-pointer">
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" class="py-1 px-2 rounded-lg text-sm mb-1">#{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row items-center justify-between gap-6 pt-10 border-t border-slate-800/50 mt-4">
                        <p class="text-[10px] text-slate-500 uppercase font-bold tracking-widest leading-relaxed max-w-[200px]">
                            Hold Ctrl / Cmd to select multiple tags.
                        </p>
                        <button type="submit" 
                            class="w-full md:w-auto bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 text-white font-black uppercase tracking-[0.2em] py-4 px-10 rounded-2xl transition-all shadow-xl shadow-indigo-600/20 active:scale-95 text-xs">
                            Create Bookmark
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
