<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .glass-panel {
            background: rgba(24, 24, 27, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .input-glass {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .input-glass:focus {
            background: rgba(255, 255, 255, 0.07);
        }
    </style>
</head>
<body class="bg-zinc-950 text-zinc-200 flex items-center justify-center min-h-screen font-sans p-4 overflow-x-hidden">

    <div class="absolute inset-0 z-0 overflow-hidden">
        <div class="absolute top-[-10%] right-[-5%] w-[50%] h-[50%] bg-indigo-600/20 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-5%] left-[-5%] w-[40%] h-[40%] bg-fuchsia-900/10 rounded-full blur-[100px]"></div>
    </div>

    <div class="relative z-10 w-full max-w-lg p-10 glass-panel rounded-3xl shadow-2xl">
        
        <div class="mb-10">
            <div class="flex items-center space-x-3 mb-2">
                <div class="w-8 h-1.5 bg-indigo-500 rounded-full"></div>
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-400">Nouveau Compte</span>
            </div>
            <h1 class="text-3xl font-black text-white tracking-tight">Rejoignez-nous</h1>
            <p class="text-zinc-400 mt-1">Créez votre profil en quelques secondes.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @csrf

            <div class="md:col-span-2 group">
                <label class="block text-xs font-semibold uppercase tracking-wider mb-2 text-zinc-500 group-focus-within:text-indigo-400 transition-colors">Nom complet</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                    class="w-full px-4 py-3 input-glass rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/50 text-white transition-all"
                    placeholder="Jean Dupont">
                @error('name')
                    <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2 group">
                <label class="block text-xs font-semibold uppercase tracking-wider mb-2 text-zinc-500 group-focus-within:text-indigo-400 transition-colors">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                    class="w-full px-4 py-3 input-glass rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/50 text-white transition-all"
                    placeholder="jean@exemple.com">
                @error('email')
                    <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="group">
                <label class="block text-xs font-semibold uppercase tracking-wider mb-2 text-zinc-500 group-focus-within:text-indigo-400 transition-colors">Mot de passe</label>
                <input type="password" name="password" required autocomplete="new-password"
                    class="w-full px-4 py-3 input-glass rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/50 text-white transition-all"
                    placeholder="••••••••">
                @error('password')
                    <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="group">
                <label class="block text-xs font-semibold uppercase tracking-wider mb-2 text-zinc-500 group-focus-within:text-indigo-400 transition-colors">Confirmer</label>
                <input type="password" name="password_confirmation" required autocomplete="new-password"
                    class="w-full px-4 py-3 input-glass rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/50 text-white transition-all"
                    placeholder="••••••••">
            </div>

            <div class="md:col-span-2 pt-4">
                <button type="submit" 
                    class="w-full py-4 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 text-white font-bold rounded-xl shadow-xl shadow-indigo-500/20 transition-all transform active:scale-[0.98]">
                    S'inscrire maintenant
                </button>
            </div>
        </form>

        <div class="mt-8 pt-6 border-t border-zinc-800/50 text-center">
            <p class="text-zinc-500 text-sm">
                Déjà membre ? <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 font-bold ml-1 transition-colors">Se connecter</a>
            </p>
        </div>
    </div>

</body>
</html>
