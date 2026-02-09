<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linker - Save Bookmark</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .glass-bg {
            background: radial-gradient(circle at top left, rgba(79, 70, 229, 0.1), transparent),
                        radial-gradient(circle at bottom right, rgba(6, 182, 212, 0.05), transparent);
        }
        .form-glass {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .input-dark {
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(51, 65, 85, 0.5);
            transition: all 0.3s ease;
        }
        .input-dark:focus {
            border-color: #6366f1;
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.2);
            background: rgba(30, 41, 59, 0.9);
        }
    </style>
</head>
<body class="bg-[#0b101a] text-slate-200 min-h-screen font-sans antialiased glass-bg flex items-center justify-center p-4">

    <div class="w-full max-w-2xl">

        <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-bold text-slate-500 hover:text-indigo-400 transition-colors mb-6 group">
            <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Dashboard
        </a>

        <div class="form-glass rounded-[2.5rem] shadow-2xl p-8 md:p-12">
            <div class="mb-10">
                <h1 class="text-3xl font-black text-white tracking-tight">
                    {{ isset($link) ? 'Edit Bookmark' : 'Add New Link' }}
                </h1>
                <p class="text-slate-400 mt-2 italic">Customize your digital resource details.</p>
            </div>

            <form action="{{ isset($link) ? route('links.update', $link->id) : route('links.store') }}" method="POST" class="space-y-8">
                @csrf
                @if(isset($link)) @method('PATCH') @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div class="md:col-span-2">
                        <label class="block text-xs font-black uppercase tracking-[0.2em] text-slate-500 mb-3 ml-1">Bookmark Title</label>
                        <input type="text" name="title" value="{{ old('title', $link->title ?? '') }}" required
                            class="w-full px-5 py-4 input-dark rounded-2xl text-white outline-none"
                            placeholder="e.g. My Portfolio Site">
                        @error('title') <p class="text-red-400 text-xs mt-2 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-black uppercase tracking-[0.2em] text-slate-500 mb-3 ml-1">Destination URL</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-5 flex items-center text-indigo-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                            </span>
                            <input type="url" name="url" value="{{ old('url', $link->url ?? '') }}" required
                                class="w-full pl-14 pr-5 py-4 input-dark rounded-2xl text-white outline-none"
                                placeholder="https://example.com">
                        </div>
                        @error('url') <p class="text-red-400 text-xs mt-2 ml-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-[0.2em] text-slate-500 mb-3 ml-1">Category</label>
                        <div class="relative">
                            <select name="category_id" class="w-full px-5 py-4 input-dark rounded-2xl text-white outline-none appearance-none cursor-pointer">
                                <option value="">Uncategorized</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ (old('category_id', $link->category_id ?? '') == $category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-[0.2em] text-slate-500 mb-3 ml-1">Privacy</label>
                        <div class="flex items-center h-[60px] px-5 input-dark rounded-2xl">
                             <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                <span class="ml-3 text-sm font-medium text-slate-400">Public Link</span>
                            </label>
                        </div>
                    </div>
                </div>


                <div class="flex flex-col md:flex-row items-center justify-end gap-4 pt-10 border-t border-slate-800/50">
                    <a href="{{ route('dashboard') }}" class="w-full md:w-auto text-center px-8 py-4 text-slate-400 font-bold hover:text-white transition-colors">
                        Cancel
                    </a>
                    <button type="submit" class="w-full md:w-auto px-10 py-4 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-500 hover:to-blue-500 text-white font-black uppercase tracking-widest rounded-2xl shadow-xl shadow-indigo-600/20 transition-all transform active:scale-95">
                        {{ isset($link) ? 'Update Bookmark' : 'Save Bookmark' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
