@extends('layouts.app')

@section('content')
<div class="bg-brand-neutral overflow-x-hidden">
    <!-- Main Product Section (Fixed on Desktop, Scrolling on Mobile) -->
    <div class="lg:h-[calc(100vh-80px)] flex items-center py-6 md:py-8 lg:overflow-hidden overflow-x-hidden">
        <div class="max-w-[1500px] w-full h-full mx-auto px-4 sm:px-8 lg:px-16">
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-16 h-full items-stretch">
                
                <!-- Left Column: Image -->
                <div class="lg:w-1/2 xl:w-7/12 lg:h-full">
                    <div class="relative w-full h-[400px] lg:h-full rounded-[40px] md:rounded-[50px] overflow-hidden border-[8px] md:border-[12px] border-white shadow-2xl shadow-red-900/5 group">
                        <img src="{{ asset('storage/' . ($pizza->images[0] ?? 'pizzas/placeholder.png')) }}" alt="{{ $pizza->name }}" 
                            class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                        
                        <!-- Floating Price Tag -->
                        <div class="absolute top-6 right-6 md:top-10 md:right-10 bg-secondary text-gray-900 px-6 py-2 md:px-8 md:py-3 rounded-2xl font-black text-xl md:text-2xl shadow-2xl rotate-3">
                            {{ number_format($pizza->price, 2) }}€
                        </div>
                    </div>
                </div>

                <!-- Right Column: Product Narrative & Actions -->
                <div class="lg:w-1/2 xl:w-5/12 lg:h-full">
                    <div class="bg-white/80 backdrop-blur-xl rounded-[40px] md:rounded-[50px] lg:h-full p-8 md:p-12 border border-white shadow-2xl shadow-gray-200/40 relative flex flex-col overflow-hidden">
                        
                        <div class="absolute -top-10 -right-10 w-40 h-40 bg-primary/5 rounded-full blur-3xl"></div>

                        <div class="relative z-10 flex flex-col lg:h-full">
                            <div class="flex-shrink-0">
                                <span class="inline-block px-4 py-1.5 rounded-full bg-primary/5 text-primary text-[10px] font-black uppercase tracking-[0.3em] mb-4 border border-primary/10">
                                    {{ $pizza->category->name }}
                                </span>

                                <h1 class="text-4xl md:text-6xl font-black text-gray-900 font-heading uppercase tracking-tighter mb-4 leading-[0.85]">
                                    {{ $pizza->name }}
                                </h1>
                                
                                <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-6">
                                    <div class="flex text-secondary gap-1">
                                        @for($i = 0; $i < 5; $i++)
                                            @svg('fas-star', ['class' => 'w-4 h-4 md:w-5 md:h-5'])
                                        @endfor
                                    </div>
                                    <span class="text-xs font-bold text-gray-400 uppercase tracking-[0.2em]">({{ __('120+ Reviews') }})</span>
                                </div>
                            </div>

                            <div class="lg:flex-1 lg:overflow-y-auto lg:pr-4 mb-6 custom-scrollbar">
                                <div class="space-y-8">
                                    <div>
                                        <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-3">{{ __('The Experience') }}</h4>
                                        <p class="text-lg text-gray-500 leading-relaxed font-medium italic">
                                            "{{ $pizza->description }}"
                                        </p>
                                    </div>

                                    <div>
                                        <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-4">{{ __('Ingredients') }}</h4>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($pizza->ingredients as $ingredient)
                                                <span class="px-4 py-2 bg-white border border-gray-100 rounded-xl text-[10px] font-black text-gray-600 uppercase tracking-widest shadow-sm">
                                                    {{ $ingredient->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-shrink-0 pt-6 border-t border-gray-100 mt-auto" x-data="{ qty: 1 }">
                                <div class="flex flex-col sm:flex-row items-center gap-6">
                                    <div class="flex items-center bg-brand-neutral rounded-[20px] p-1 border border-gray-100">
                                        <button @click="if(qty > 1) qty--" class="w-12 h-12 flex items-center justify-center rounded-[15px] bg-white shadow-sm hover:text-primary font-black transition-all text-xl active:scale-90">-</button>
                                        <span class="w-12 text-center font-black text-gray-900 text-xl font-heading" x-text="qty">1</span>
                                        <button @click="qty++" class="w-12 h-12 flex items-center justify-center rounded-[15px] bg-white shadow-sm hover:text-primary font-black transition-all text-xl active:scale-90">+</button>
                                    </div>
                                    <div class="flex-1 w-full">
                                        <x-ui.button variant="primary" icon="fas-shopping-basket" fullWidth class="group" 
                                            @click="$dispatch('pizza:add-to-cart', { 
                                                pizzaId: {{ $pizza->id }}, 
                                                quantity: qty,
                                                name: '{{ $pizza->name }}', 
                                                price: {{ $pizza->price }}, 
                                                image: '{{ $pizza->images[0] ?? 'pizzas/placeholder.png' }}' 
                                            })">
                                            <span>{{ __('Add to Order') }}</span>
                                            <span class="opacity-30 mx-1">|</span>
                                            <span class="italic text-lg font-black font-heading tracking-tight" x-text="(qty * {{ $pizza->price }}).toFixed(2) + '€'">{{ number_format($pizza->price, 2) }}€</span>
                                        </x-ui.button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Pizzas Section (Mini Version) -->
    @if($relatedPizzas->count() > 0)
        <div class="bg-white py-16 md:py-24 relative overflow-hidden">
            <div class="absolute inset-0 opacity-[0.03] pointer-events-none" 
                 style="background-image: radial-gradient(#000 1.5px, transparent 1.5px); background-size: 40px 40px;"></div>
            
            <div class="max-w-[1500px] mx-auto px-4 sm:px-8 lg:px-16 relative z-10">
                <div class="mb-12">
                    <span class="text-primary font-black uppercase tracking-[0.3em] text-[10px] mb-4 block">{{ __('Recommendations') }}</span>
                    <h2 class="text-3xl md:text-5xl font-black text-gray-900 font-heading uppercase tracking-tighter leading-none">
                        {{ __('You might also') }} <span class="text-primary italic">{{ __('like') }}</span>
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($relatedPizzas as $related)
                        <div class="bg-brand-neutral/50 p-2 rounded-[30px] border border-gray-50 hover:bg-white hover:shadow-xl transition-all">
                            <x-mini-product-card :pizza="$related" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #D32F2F; }
</style>
@endsection
