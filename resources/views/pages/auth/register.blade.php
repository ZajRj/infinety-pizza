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
                <span class="text-primary font-black uppercase tracking-[0.3em] text-[10px] mb-4 block">Join the Family</span>
                <h2 class="text-4xl font-black text-gray-900 font-heading uppercase tracking-tighter leading-none">Create Your <span class="text-primary italic">Account</span></h2>
            </div>

            <!-- Form -->
            <form action="{{ route('register') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Leonardo Da Vinci" required
                            class="w-full bg-brand-neutral/50 border @error('name') border-primary @else border-gray-100 @enderror rounded-2xl px-5 py-4 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-medium text-gray-700">
                        @error('name')
                            <p class="mt-2 text-[10px] font-bold text-primary uppercase tracking-wide px-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="dni" class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">DNI / ID Number</label>
                        <input type="text" id="dni" name="dni" value="{{ old('dni') }}" placeholder="12345678X" required
                            class="w-full bg-brand-neutral/50 border @error('dni') border-primary @else border-gray-100 @enderror rounded-2xl px-5 py-4 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-medium text-gray-700">
                        @error('dni')
                            <p class="mt-2 text-[10px] font-bold text-primary uppercase tracking-wide px-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="phone_number" class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Phone Number</label>
                        <input type="tel" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" placeholder="+34 600 000 000" 
                            class="w-full bg-brand-neutral/50 border @error('phone_number') border-primary @else border-gray-100 @enderror rounded-2xl px-5 py-4 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-medium text-gray-700">
                        @error('phone_number')
                            <p class="mt-2 text-[10px] font-bold text-primary uppercase tracking-wide px-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="leo@artisanal.com" required
                            class="w-full bg-brand-neutral/50 border @error('email') border-primary @else border-gray-100 @enderror rounded-2xl px-5 py-4 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-medium text-gray-700">
                        @error('email')
                            <p class="mt-2 text-[10px] font-bold text-primary uppercase tracking-wide px-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="password" class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Password</label>
                        <input type="password" id="password" name="password" placeholder="••••••••" required
                            class="w-full bg-brand-neutral/50 border @error('password') border-primary @else border-gray-100 @enderror rounded-2xl px-5 py-4 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-medium text-gray-700">
                        @error('password')
                            <p class="mt-2 text-[10px] font-bold text-primary uppercase tracking-wide px-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required
                            class="w-full bg-brand-neutral/50 border border-gray-100 rounded-2xl px-5 py-4 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-medium text-gray-700">
                    </div>
                </div>

                <div class="flex items-start px-1 pt-2">
                    <input type="checkbox" id="terms" required class="mt-1 w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary">
                    <label for="terms" class="ml-2 text-xs font-bold text-gray-500 uppercase tracking-wide leading-relaxed cursor-pointer">
                        I agree to the <a href="#" class="text-primary hover:underline">Terms of Service</a> and <a href="#" class="text-primary hover:underline">Privacy Policy</a>.
                    </label>
                </div>

                <button type="submit" class="w-full bg-primary text-white py-5 rounded-2xl font-black text-sm uppercase tracking-[0.2em] shadow-xl shadow-red-900/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-3">
                    @svg('fas-user-plus', ['class' => 'w-4 h-4'])
                    Create Account
                </button>
            </form>

            <!-- Footer -->
            <div class="mt-10 text-center">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">
                    Already part of the family? 
                    <a href="{{ route('login') }}" class="text-primary hover:underline ml-1">Sign in here</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
