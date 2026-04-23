@extends('layouts.app')

@section('content')
<div class="bg-brand-neutral min-h-screen py-12 md:py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-4xl md:text-5xl font-black text-gray-900 font-heading uppercase tracking-tighter mb-2">Checkout</h1>
            <p class="text-gray-500 font-medium italic">Review your selection and complete your order.</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-12 items-start">
            
            <!-- Left Column: Your Selection -->
            <div class="lg:w-2/3 w-full">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-black text-gray-900 font-heading uppercase tracking-tighter">Your Selection</h2>
                    <span class="bg-secondary text-gray-900 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest">{{ $items->count() }} Items</span>
                </div>

                <div class="space-y-6">
                    @foreach($items as $item)
                        <div class="bg-white rounded-[32px] p-6 border border-gray-100 shadow-xl shadow-gray-200/20 group hover:shadow-2xl hover:shadow-red-900/5 transition-all">
                            <div class="flex flex-col sm:flex-row gap-6 items-center">
                                <!-- Item Image -->
                                <div class="w-24 h-24 flex-shrink-0 bg-brand-neutral rounded-2xl overflow-hidden border border-gray-50">
                                    <img src="{{ asset('storage/' . ($item->images[0] ?? 'pizzas/placeholder.png')) }}" alt="{{ $item->name }}" class="w-full h-full object-cover">
                                </div>

                                <!-- Item Info -->
                                <div class="flex-1 text-center sm:text-left">
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-2 gap-2">
                                        <h3 class="text-xl font-black text-gray-900 font-heading uppercase tracking-tight">{{ $item->name }}</h3>
                                        <span class="text-lg font-black text-primary italic">${{ number_format($item->price, 2) }}</span>
                                    </div>
                                    <p class="text-sm text-gray-400 font-medium mb-4 line-clamp-1">
                                        {{ $item->description }}
                                    </p>
                                    
                                    <div class="flex items-center justify-center sm:justify-between">
                                        <div class="flex items-center bg-gray-50 rounded-xl p-1 border border-gray-100">
                                            <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-white shadow-sm hover:text-primary font-bold transition-all">-</button>
                                            <span class="w-10 text-center font-black text-gray-900 text-sm">1</span>
                                            <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-white shadow-sm hover:text-primary font-bold transition-all">+</button>
                                        </div>
                                        <button class="hidden sm:flex items-center gap-2 text-[10px] font-black text-gray-300 uppercase tracking-widest hover:text-primary transition-colors">
                                            @svg('fas-trash-alt', ['class' => 'w-3 h-3'])
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Special Instructions -->
                <div class="mt-12">
                    <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-4">Special Instructions</h4>
                    <textarea 
                        placeholder="E.g. Extra crispy crust, light on cheese..."
                        class="w-full bg-white rounded-[32px] p-6 border border-gray-100 shadow-xl shadow-gray-200/10 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none font-medium text-gray-700 min-h-[120px]"
                    ></textarea>
                </div>
            </div>

            <!-- Right Column: Order Summary -->
            <div class="lg:w-1/3 w-full sticky top-32">
                <div class="bg-white/80 backdrop-blur-xl rounded-[40px] p-10 border border-white shadow-2xl shadow-gray-200/40">
                    <h2 class="text-2xl font-black text-gray-900 font-heading uppercase tracking-tighter mb-8 pb-8 border-b border-gray-100">Order Summary</h2>

                    <div class="space-y-4 mb-10">
                        <div class="flex justify-between items-center text-sm font-medium">
                            <span class="text-gray-400 uppercase tracking-widest">Subtotal</span>
                            <span class="text-gray-900 font-black italic">$47.50</span>
                        </div>
                        <div class="flex justify-between items-center text-sm font-medium">
                            <span class="text-gray-400 uppercase tracking-widest">Tax (8.5%)</span>
                            <span class="text-gray-900 font-black italic">$4.04</span>
                        </div>
                        <div class="flex justify-between items-center text-sm font-medium">
                            <span class="text-gray-400 uppercase tracking-widest">Delivery Fee</span>
                            <span class="text-tertiary font-black italic">FREE</span>
                        </div>
                        <div class="flex justify-between items-center pt-6 border-t border-gray-50">
                            <span class="text-gray-900 font-black text-xl uppercase tracking-tighter font-heading">Total</span>
                            <span class="text-3xl font-black text-primary italic leading-none">$51.54</span>
                        </div>
                    </div>

                    <!-- Delivery Address Card -->
                    <div class="mb-6 p-6 rounded-3xl bg-brand-neutral/50 border border-gray-50 group hover:border-primary/20 transition-all">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Delivery Address</h4>
                            <button class="text-[10px] font-black text-primary uppercase tracking-widest hover:underline">Change</button>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="bg-white p-2 rounded-xl text-primary shadow-sm">
                                @svg('fas-home', ['class' => 'w-4 h-4'])
                            </div>
                            <div>
                                <p class="text-xs font-black text-gray-900">Home</p>
                                <p class="text-[10px] font-medium text-gray-500 leading-relaxed">123 Artisan Way, Apt 4B<br>New York, NY 10001</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method Card -->
                    <div class="mb-10 p-6 rounded-3xl bg-brand-neutral/50 border border-gray-50 group hover:border-primary/20 transition-all">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Payment Method</h4>
                            <button class="text-[10px] font-black text-primary uppercase tracking-widest hover:underline">Edit</button>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="bg-white p-2 rounded-xl text-gray-900 shadow-sm">
                                    @svg('fab-cc-visa', ['class' => 'w-5 h-5'])
                                </div>
                                <p class="text-xs font-black text-gray-900">Visa ending in •••• 4242</p>
                            </div>
                            <div class="text-tertiary">
                                @svg('fas-check-circle', ['class' => 'w-4 h-4'])
                            </div>
                        </div>
                    </div>

                    <button class="w-full bg-primary text-white py-5 rounded-[25px] font-black text-sm uppercase tracking-[0.2em] shadow-2xl shadow-red-900/30 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-4 group">
                        @svg('fas-lock', ['class' => 'w-4 h-4 group-hover:-translate-y-1 transition-transform'])
                        Place Order
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
