<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .glass-panel {
            background: rgba(24, 24, 27, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .input-glass {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body class="bg-zinc-950 text-zinc-200 flex items-center justify-center min-h-screen font-sans overflow-hidden">

    <div class="absolute inset-0 z-0">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-indigo-900/30 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-purple-900/20 rounded-full blur-[120px]"></div>
    </div>

    <div class="relative z-10 w-full max-w-md p-10 glass-panel rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
        
        <div class="mb-10 text-center">
            <div class="inline-flex items-center justify-center w-12 h-12 mb-4 rounded-xl bg-indigo-600 shadow-lg shadow-indigo-500/30">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Bienvenue</h1>
            <p class="text-zinc-400 mt-2">Connectez-vous à votre espace personnel</p>
        </div>

        @if (session('status'))
            <div class="mb-6 p-3 rounded-lg bg-green-500/10 border border-green-500/20 text-sm font-medium text-green-400 text-center">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div class="group">
                <label class="block text-xs font-semibold uppercase tracking-wider mb-2 text-zinc-500 group-focus-within:text-indigo-400 transition-colors">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-3 input-glass rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/50 text-white transition-all placeholder-zinc-600"
                    placeholder="nom@exemple.com">
                @error('email')
                    <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="group">
                <label class="block text-xs font-semibold uppercase tracking-wider mb-2 text-zinc-500 group-focus-within:text-indigo-400 transition-colors">Mot de passe</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 input-glass rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/50 text-white transition-all"
                    placeholder="••••••••">
                @error('password')
                    <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center cursor-pointer group">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-zinc-700 bg-zinc-800 text-indigo-600 focus:ring-0 transition-all">
                    <span class="ml-2 text-zinc-400 group-hover:text-zinc-200 transition-colors">Rester connecté</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-indigo-400 hover:text-indigo-300 font-medium">Oublié ?</a>
                @endif
            </div>

            <button type="submit" 
                class="w-full py-4 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white font-bold rounded-xl shadow-xl shadow-indigo-500/20 transition-all transform active:scale-[0.98]">
                Se connecter
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-zinc-800/50 text-center">
            <p class="text-zinc-500 text-sm">
                Nouveau ici ? <a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300 font-bold ml-1">Créer un compte</a>
            </p>
        </div>
    </div>

</body>
</html>
