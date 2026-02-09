<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .glass-panel { background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.08); }
        .cyber-input { background: rgba(15, 23, 42, 0.9); border: 1px solid rgba(51, 65, 85, 0.5); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .cyber-input:focus { border-color: #3b82f6; box-shadow: 0 0 20px rgba(59, 130, 246, 0.2); }
    </style>
</head>
<body class="bg-[#020617] text-slate-200 min-h-screen flex items-center justify-center p-6 relative overflow-hidden">

    <div class="absolute top-[-15%] right-[-10%] w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-[-15%] left-[-10%] w-[500px] h-[500px] bg-indigo-600/10 rounded-full blur-[120px]"></div>

    <div class="relative z-10 w-full max-w-md">
        
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-blue-600/10 border border-blue-500/20 mb-6 shadow-2xl shadow-blue-500/5">
                <svg class="w-10 h-10 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                </svg>
            </div>
            <h1 class="text-4xl font-black text-white tracking-tighter italic mb-3">RECOVERY<span class="text-blue-500">.KEY</span></h1>
            <p class="text-slate-500 text-[10px] font-bold uppercase tracking-[0.3em] max-w-[320px] mx-auto leading-relaxed">
                Forgot your password? Enter your email address and we will email you a reset link.
            </p>
        </div>

        <div class="glass-panel rounded-[3rem] p-10 shadow-2xl">
            @if (session('status'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-bold text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-8">
                @csrf

                <div class="group">
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-3 ml-1 group-focus-within:text-blue-400 transition-colors">Registered Email</label>
                    <input type="email" name="email" :value="old('email')" required autofocus
                        class="w-full px-6 py-5 cyber-input rounded-2xl text-white outline-none placeholder-slate-700 text-sm"
                        placeholder="nom@domaine.com">
                    @if($errors->has('email'))
                        <p class="mt-3 text-[11px] text-red-400 font-medium italic ml-1">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div class="pt-2">
                    <button type="submit" 
                        class="w-full py-5 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 text-white font-black uppercase tracking-[0.3em] rounded-2xl shadow-2xl shadow-blue-600/20 transition-all transform active:scale-[0.97] text-xs">
                        {{ __('Email Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('login') }}" class="inline-flex items-center text-slate-500 hover:text-white transition-all text-xs font-bold uppercase tracking-widest group">
                <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Return to Login
            </a>
        </div>
    </div>

</body>
</html>
