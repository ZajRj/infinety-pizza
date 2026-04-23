
@props(['pizza'])
<div
    class="bg-white/90 backdrop-blur-md rounded-[24px] p-4 border border-gray-100 shadow-sm hover:shadow-md transition-all flex items-center gap-4 relative overflow-hidden group">
    <div
        class="absolute top-0 right-0 w-12 h-12 bg-primary/5 rounded-full -mr-6 -mt-6 group-hover:scale-150 transition-transform">
    </div>

    <a href="{{ route('pizzas.show', $pizza) }}" class="block">
        <div class="w-16 h-16 flex-shrink-0 bg-gray-50 rounded-xl overflow-hidden relative z-10">
            <img src="{{ asset('storage/' . ($pizza->images[0] ?? 'pizzas/placeholder.png')) }}" alt="{{ $pizza->name }}"
                class="w-full h-full object-cover">
        </div>
    </a>

    <div class="flex-1 min-w-0 relative z-10" x-data="{ qty: 1 }">
        <div class="flex flex-col mb-2">
            <span class="text-sm font-black text-gray-900 truncate">{{ $pizza->name }}</span>
            <span class="text-sm font-black text-primary italic">{{ number_format($pizza->price, 2) }}€</span>
        </div>

        <div class="flex items-center gap-2">
            <div class="flex items-center border border-gray-100 rounded-lg overflow-hidden h-7">
                <button @click="if(qty > 1) qty--" class="px-1.5 hover:bg-gray-50 text-gray-400 text-xs font-bold">-</button>
                <span x-text="qty" class="w-6 text-center text-[10px] font-bold text-gray-900">1</span>
                <button @click="qty++" class="px-1.5 hover:bg-gray-50 text-gray-400 text-xs font-bold">+</button>
            </div>
            <x-ui.button variant="secondary" size="sm" class="flex-1 rounded-lg" @click="$dispatch('add-to-cart', { 
                pizzaId: {{ $pizza->id }}, 
                quantity: qty,
                name: '{{ $pizza->name }}', 
                price: {{ $pizza->price }}, 
                image: '{{ $pizza->images[0] ?? 'pizzas/placeholder.png' }}' 
            })">
                {{ __('Add to Cart') }}
            </x-ui.button>
        </div>
    </div>
</div>