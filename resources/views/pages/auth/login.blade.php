@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary/10 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>

    <div class="max-w-md w-full relative z-10">
        <div class="bg-white/80 backdrop-blur-xl rounded-[40px] shadow-2xl shadow-gray-200/50 border border-white p-10 md:p-12">
            <!-- Header -->
            <div class="text-center mb-10">
                <span class="text-primary font-black uppercase tracking-[0.3em] text-[10px] mb-4 block">Welcome Back</span>
                <h2 class="text-4xl font-black text-gray-900 font-heading uppercase tracking-tighter leading-none">Login to <span class="text-primary italic">Infinety</span></h2>
            </div>

            <!-- Form -->
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="chef@infinety.com" required autofocus
                        class="w-full bg-brand-neutral/50 border @error('email') border-primary @else border-gray-100 @enderror rounded-2xl px-5 py-4 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-medium text-gray-700">
                    @error('email')
                        <p class="mt-2 text-[10px] font-bold text-primary uppercase tracking-wide px-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex justify-between items-center px-1 mb-2">
                        <label for="password" class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">Password</label>
                        <a href="{{ route('password.request') }}" class="text-[9px] font-black text-primary uppercase tracking-widest hover:underline">Forgot?</a>
                    </div>
                    <input type="password" id="password" name="password" placeholder="••••••••" required
                        class="w-full bg-brand-neutral/50 border border-gray-100 rounded-2xl px-5 py-4 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-medium text-gray-700">
                </div>

                <div class="flex items-center px-1">
                    <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary">
                    <label for="remember" class="ml-2 text-xs font-bold text-gray-500 uppercase tracking-wide cursor-pointer">Remember me</label>
                </div>

                <button type="submit" class="w-full bg-primary text-white py-5 rounded-2xl font-black text-sm uppercase tracking-[0.2em] shadow-xl shadow-red-900/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-3">
                    @svg('fas-sign-in-alt', ['class' => 'w-4 h-4'])
                    Sign In
                </button>
            </form>

            <!-- Footer -->
            <div class="mt-10 text-center">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">
                    New to the family? 
                    <a href="{{ route('register') }}" class="text-primary hover:underline ml-1">Create an account</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
