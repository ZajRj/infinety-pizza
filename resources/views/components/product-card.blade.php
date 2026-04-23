@props(['pizza'])

<div class="shadow-md group relative bg-white p-4 rounded-[40px] border border-gray-100 transition-all hover:shadow-2xl hover:shadow-red-900/5 hover:-translate-y-1">
    <a href="{{ route('pizzas.show', $pizza) }}" class="block">
        <div class="aspect-square rounded-[32px] overflow-hidden bg-gray-50 mb-4 border border-gray-100 transition-all">
            <img src="{{ asset('storage/' . ($pizza->images[0] ?? 'pizzas/placeholder.png')) }}" alt="{{ $pizza->name }}"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
            <div class="absolute top-8 right-8">
                <span class="bg-white/90 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-black text-primary uppercase tracking-widest shadow-sm">
                    {{ $pizza->category->name }}
                </span>
            </div>
        </div>
    </a>
    <div class="px-2">
        <div class="flex justify-between items-start mb-1">
            <h3 class="text-lg font-black text-gray-900 font-heading leading-tight uppercase">{{ $pizza->name }}</h3>
            <span class="text-lg font-black text-primary italic">${{ number_format($pizza->price, 2) }}</span>
        </div>
        <p class="text-gray-400 text-xs line-clamp-2 leading-relaxed mb-4">
            {{ $pizza->description }}
        </p>
        <x-ui.button variant="outline" fullWidth>
            Quick Add
        </x-ui.button>
    </div>
</div>