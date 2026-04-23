<!-- Main Menu Section -->
<div class="bg-brand-neutral">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <section id="menu" class="py-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-black text-gray-900 mb-2 font-heading uppercase tracking-tighter">The Full Menu</h2>
                <div class="h-1 w-16 bg-primary mx-auto"></div>
            </div>

            <!-- Categories -->
            <div class="flex flex-wrap justify-center gap-3 mb-12">
                <button class="px-6 py-2 rounded-full bg-primary text-white font-bold text-sm shadow-lg shadow-red-900/10">All Pizzas</button>
                @foreach($categories as $category)
                    <button class="px-6 py-2 rounded-full bg-white border border-gray-100 text-gray-500 font-bold text-sm hover:border-primary hover:text-primary transition-all">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            <!-- Main Menu Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($pizzas as $pizza)
                    <x-product-card :pizza="$pizza" />
                @endforeach
            </div>
        </section>
    </div>
</div>
