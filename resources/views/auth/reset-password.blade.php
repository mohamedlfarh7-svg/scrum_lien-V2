<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Linker Security</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .glass-panel {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .cyber-input {
            background: rgba(15, 23, 42, 0.9);
            border: 1px solid rgba(51, 65, 85, 0.5);
            transition: all 0.3s ease;
        }
        .cyber-input:focus {
            border-color: #a855f7;
            box-shadow: 0 0 15px rgba(168, 85, 247, 0.2);
        }
    </style>
</head>
<body class="bg-[#020617] text-slate-200 min-h-screen flex items-center justify-center p-6 relative overflow-hidden">


    <div class="absolute top-[-10%] left-[-10%] w-[400px] h-[400px] bg-purple-600/10 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[400px] h-[400px] bg-blue-600/10 rounded-full blur-[120px]"></div>

    <div class="relative z-10 w-full max-w-md">

        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-purple-600/20 border border-purple-500/30 mb-4 shadow-xl shadow-purple-500/10">
                <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <h1 class="text-3xl font-black text-white tracking-tighter italic">SECURITY<span class="text-purple-500">.RESET</span></h1>
            <p class="text-slate-500 text-sm mt-2 uppercase tracking-widest">Update your credentials</p>
        </div>

        <div class="glass-panel rounded-[2.5rem] p-8 md:p-10 shadow-2xl">
            <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="group">
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2 ml-1 group-focus-within:text-purple-400 transition-colors">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus
                        class="w-full px-5 py-4 cyber-input rounded-2xl text-white outline-none placeholder-slate-600"
                        placeholder="your@email.com">
                    @if($errors->has('email'))
                        <p class="mt-2 text-xs text-red-400 ml-1 italic">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div class="group">
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2 ml-1 group-focus-within:text-purple-400 transition-colors">New Password</label>
                    <input type="password" name="password" required
                        class="w-full px-5 py-4 cyber-input rounded-2xl text-white outline-none placeholder-slate-600"
                        placeholder="••••••••">
                    @if($errors->has('password'))
                        <p class="mt-2 text-xs text-red-400 ml-1 italic">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <!-- Confirm Password -->
                <div class="group">
                    <label class="block text-xs font-black uppercase tracking-widest text-slate-500 mb-2 ml-1 group-focus-within:text-purple-400 transition-colors">Confirm Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-5 py-4 cyber-input rounded-2xl text-white outline-none placeholder-slate-600"
                        placeholder="••••••••">
                </div>

                <div class="pt-4">
                    <button type="submit" 
                        class="w-full py-4 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white font-black uppercase tracking-[0.2em] rounded-2xl shadow-xl shadow-purple-600/20 transition-all transform active:scale-95 text-xs">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>

        <p class="text-center mt-8 text-slate-600 text-xs font-bold uppercase tracking-widest">
            Back to <a href="{{ route('login') }}" class="text-purple-500 hover:underline">Login Interface</a>
        </p>
    </div>

</body>
</html>
