<x-guest-layout>
    <style>
        .login-bg {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                        url('{{ asset("images/hero-car.jpg") }}');
            background-size: cover;
            background-position: center;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>

    <div class="login-bg min-h-screen flex flex-col justify-center items-center p-6">
        
        <a href="/" class="absolute top-8 left-8 text-white/70 hover:text-white flex items-center gap-2 text-sm transition">
            ← Kembali
        </a>

        <div class="glass-card w-full max-w-md p-8 rounded-[2rem] shadow-2xl">
            
            <div class="flex justify-center mb-6">
                <div class="bg-red-600/20 p-3 rounded-2xl border border-red-500/30">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
            </div>

            <div class="text-center mb-8">
                <h2 class="text-3xl font-black text-white tracking-tight">Welcome Back</h2>
                <p class="text-white/50 text-sm mt-2">Sign in to your automotive management system</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-white/40 mb-2 ml-1">Email Address</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-white/30">📧</span>
                        <input type="email" name="email" :value="old('email')" required autofocus 
                               class="w-full pl-11 pr-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-white/20 focus:border-red-500 focus:ring-0 transition"
                               placeholder="you@company.com">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-xs" />
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-white/40 mb-2 ml-1">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-white/30">🔒</span>
                        <input type="password" name="password" required 
                               class="w-full pl-11 pr-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-white/20 focus:border-red-500 focus:ring-0 transition"
                               placeholder="••••••••">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400 text-xs" />
                </div>

                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center text-white/60 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded bg-white/5 border-white/20 text-red-600 focus:ring-0 mr-2">
                        Remember me
                    </label>
                    <a href="{{ route('password.request') }}" class="font-bold text-red-500 hover:text-red-400">Forgot password?</a>
                </div>

                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-black py-4 rounded-xl shadow-lg shadow-red-600/20 transition transform active:scale-95 uppercase text-xs tracking-widest mt-4">
                    Sign In
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-[10px] text-white/30 font-bold uppercase tracking-widest">
                    Powered by CV. Nusantara Motor
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>