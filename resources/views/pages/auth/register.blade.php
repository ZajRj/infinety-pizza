@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-secondary/10 rounded-full blur-3xl -translate-x-1/2 translate-y-1/2"></div>

    <div class="max-w-xl w-full relative z-10">
        <div class="bg-white/80 backdrop-blur-xl rounded-[40px] shadow-2xl shadow-gray-200/50 border border-white p-10 md:p-12">
            <!-- Header -->
            <div class="text-center mb-10">
                <span class="text-primary font-black uppercase tracking-[0.3em] text-[10px] mb-4 block">{{ __('auth.register_title') }}</span>
                <h2 class="text-4xl font-black text-gray-900 font-heading uppercase tracking-tighter leading-none">{{ __('Create Your') }} <span class="text-primary italic">Account</span></h2>
            </div>

            <!-- Form -->
            <form action="{{ route('register') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-ui.input :label="__('auth.name')" name="name" :value="old('name')" placeholder="Leonardo Da Vinci" required />
                    <x-ui.input :label="__('auth.dni')" name="dni" :value="old('dni')" placeholder="12345678X" required />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-ui.input :label="__('auth.phone_number')" name="phone_number" type="tel" :value="old('phone_number')" placeholder="+34 600 000 000" />
                    <x-ui.input :label="__('auth.email')" name="email" type="email" :value="old('email')" placeholder="leo@artisanal.com" required />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-ui.input :label="__('auth.password_label')" name="password" type="password" placeholder="••••••••" required />
                    <x-ui.input :label="__('auth.confirm_password')" name="password_confirmation" type="password" placeholder="••••••••" required />
                </div>

                <div class="flex items-start px-1 pt-2">
                    <input type="checkbox" id="terms" required class="mt-1 w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary">
                    <label for="terms" class="ml-2 text-xs font-bold text-gray-500 uppercase tracking-wide leading-relaxed cursor-pointer">
                        {!! __('auth.terms_agreement', [
                            'terms' => '<a href="#" class="text-primary hover:underline">'.__('auth.terms').'</a>',
                            'privacy' => '<a href="#" class="text-primary hover:underline">'.__('auth.privacy').'</a>'
                        ]) !!}
                    </label>
                </div>

                <x-ui.button type="submit" variant="primary" icon="fas-user-plus" fullWidth>
                    {{ __('auth.register_button') }}
                </x-ui.button>
            </form>

            <!-- Footer -->
            <div class="mt-10 text-center">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">
                    {{ __('auth.already_account') }} 
                    <a href="{{ route('login') }}" class="text-primary hover:underline ml-1">{{ __('auth.sign_in_here') }}</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
