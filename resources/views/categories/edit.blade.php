<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linker - Edit Category</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .glass-card {
            background: linear-gradient(145deg, rgba(30, 41, 59, 0.4), rgba(15, 23, 42, 0.7));
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body class="bg-[#0b101a] text-slate-200 p-4 md:p-10 font-sans antialiased">

    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('categories.index') }}" class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-emerald-400 transition-colors mb-6 group">
                <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back to Categories
            </a>
            <h1 class="text-3xl font-black text-white tracking-tight">Edit Category</h1>
            <p class="text-slate-400 mt-2">Update the name for <span class="text-emerald-400">"{{ $category->name }}"</span></p>
        </div>

        <div class="glass-card p-8 rounded-3xl shadow-2xl">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-6">
                    <label for="name" class="block text-sm font-black text-slate-500 uppercase tracking-widest mb-3">Category Name</label>
                    <input type="text" name="name" id="name" 
                        value="{{ old('name', $category->name) }}"
                        class="w-full bg-slate-900/50 border border-slate-800 rounded-2xl px-5 py-4 text-white focus:ring-2 focus:ring-emerald-500/50 focus:border-emerald-500 transition-all outline-none"
                        placeholder="e.g. Development, Design..." required>
                    
                    @error('name')
                        <p class="text-red-400 text-xs mt-2 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="flex-1 bg-emerald-600 hover:bg-emerald-500 text-white font-black py-4 rounded-2xl transition shadow-lg shadow-emerald-600/20 active:scale-[0.98]">
                        Save Changes
                    </button>
                    <a href="{{ route('categories.index') }}" class="px-8 py-4 bg-slate-800 hover:bg-slate-700 text-slate-300 font-bold rounded-2xl transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>

        <div class="mt-8 p-4 bg-indigo-500/5 border border-indigo-500/10 rounded-2xl flex items-start gap-4">
            <div class="p-2 bg-indigo-500/10 text-indigo-400 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-sm text-slate-500 leading-relaxed">
                Changing the category name will automatically update all links associated with it. Don't worry, your data is safe!
            </p>
        </div>
    </div>

</body>
</html>