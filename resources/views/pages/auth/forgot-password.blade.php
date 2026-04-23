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
                <div class="w-20 h-20 bg-primary/5 rounded-3xl flex items-center justify-center mx-auto mb-6">
                    @svg('fas-key', ['class' => 'w-8 h-8 text-primary opacity-50'])
                </div>
                <span class="text-primary font-black uppercase tracking-[0.3em] text-[10px] mb-4 block">Password Recovery</span>
                <h2 class="text-4xl font-black text-gray-900 font-heading uppercase tracking-tighter leading-none mb-4">Forgot <span class="text-primary italic">Secret?</span></h2>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wide leading-relaxed">
                    No worries! Enter your email and we'll send you a link to reset it.
                </p>
            </div>

            <!-- Form -->
            <form action="#" class="space-y-6">
                <div>
                    <label for="email" class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Email Address</label>
                    <input type="email" id="email" placeholder="chef@infinety.com" 
                        class="w-full bg-brand-neutral/50 border border-gray-100 rounded-2xl px-5 py-4 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-medium text-gray-700">
                </div>

                <button type="submit" class="w-full bg-primary text-white py-5 rounded-2xl font-black text-sm uppercase tracking-[0.2em] shadow-xl shadow-red-900/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-3">
                    @svg('fas-paper-plane', ['class' => 'w-4 h-4'])
                    Send Reset Link
                </button>
            </form>

            <!-- Footer -->
            <div class="mt-10 text-center">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">
                    Remembered it? 
                    <a href="{{ route('login') }}" class="text-primary hover:underline ml-1">Sign in here</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
