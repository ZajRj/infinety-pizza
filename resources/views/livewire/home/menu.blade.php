<!-- Main Menu Section -->
<div class="bg-brand-neutral min-h-[600px]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <section id="menu" class="py-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-black text-gray-900 mb-2 font-heading uppercase tracking-tighter">{{ __('The Full Menu') }}</h2>
                <div class="h-1 w-16 bg-primary mx-auto"></div>
            </div>

            <!-- Categories -->
            <div class="flex flex-wrap justify-center gap-3 mb-12">
                <button 
                    wire:click="setCategory(null)"
                    class="px-6 py-2 rounded-full text-xs font-black uppercase tracking-widest transition-all {{ is_null($categoryId) ? 'bg-primary text-white shadow-lg shadow-red-900/20 scale-105' : 'bg-white text-gray-400 border border-gray-100 hover:border-primary/20' }}"
                >
                    {{ __('All Pizzas') }}
                </button>
                @foreach($categories as $category)
                    <button 
                        wire:click="setCategory({{ $category->id }})"
                        class="px-6 py-2 rounded-full text-xs font-black uppercase tracking-widest transition-all {{ $categoryId == $category->id ? 'bg-primary text-white shadow-lg shadow-red-900/20 scale-105' : 'bg-white text-gray-400 border border-gray-100 hover:border-primary/20 hover:text-gray-600' }}"
                    >
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            <!-- Main Menu Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16" wire:loading.class="opacity-50 transition-opacity">
                @foreach($pizzas as $pizza)
                    <x-product-card :pizza="$pizza" />
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center">
                {{ $pizzas->links() }}
            </div>
        </section>
    </div>
</div>
