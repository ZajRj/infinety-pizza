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
                <x-ui.input 
                    label="Email Address" 
                    name="email" 
                    type="email" 
                    placeholder="leo@artisanal.com" 
                    required 
                    :value="old('email')"
                />

                <x-ui.input 
                    label="Password" 
                    name="password" 
                    type="password" 
                    placeholder="••••••••" 
                    required 
                />

                <div class="flex items-center justify-between px-1">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary">
                        <span class="ml-2 text-xs font-bold text-gray-500 uppercase tracking-wide">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs font-bold text-primary hover:underline uppercase tracking-wide">Forgot password?</a>
                    @endif
                </div>

                <x-ui.button type="submit" variant="primary" icon="fas-sign-in-alt" fullWidth>
                    Sign In
                </x-ui.button>
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
