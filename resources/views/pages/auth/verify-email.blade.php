@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-secondary/10 rounded-full blur-3xl -translate-x-1/2 translate-y-1/2"></div>

    <div class="max-w-md w-full relative z-10">
        <div class="bg-white/80 backdrop-blur-xl rounded-[40px] shadow-2xl shadow-gray-200/50 border border-white p-10 md:p-12 text-center">
            
            <div class="w-20 h-20 bg-tertiary/10 rounded-3xl flex items-center justify-center mx-auto mb-8">
                @svg('fas-paper-plane', ['class' => 'w-8 h-8 text-tertiary opacity-70'])
            </div>

            <!-- Header -->
            <div class="mb-8">
                <span class="text-tertiary font-black uppercase tracking-[0.3em] text-[10px] mb-4 block">Verify Your Email</span>
                <h2 class="text-4xl font-black text-gray-900 font-heading uppercase tracking-tighter leading-none mb-4">Check Your <span class="text-primary italic">Inbox</span></h2>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wide leading-relaxed">
                    Thanks for joining the family! Before we get started, please click the link we just sent to your email.
                </p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-8 bg-tertiary/5 border border-tertiary/10 p-4 rounded-2xl">
                    <p class="text-[10px] font-black text-tertiary uppercase tracking-widest">
                        A new verification link has been sent!
                    </p>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('verification.send') }}" method="POST" class="space-y-4">
                @csrf
                <x-ui.button type="submit" variant="primary" fullWidth>
                    Resend Email
                </x-ui.button>
            </form>

            <!-- Logout Option -->
            <form action="{{ route('logout') }}" method="POST" class="mt-8">
                @csrf
                <x-ui.button type="submit" variant="white" size="sm">
                    Sign Out
                </x-ui.button>
            </form>

        </div>
    </div>
</div>
@endsection
