<!-- Main Menu Section -->
<div class="bg-brand-neutral">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <section id="menu" class="py-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-black text-gray-900 mb-2 font-heading uppercase tracking-tighter">{{ __('The Full Menu') }}</h2>
                <div class="h-1 w-16 bg-primary mx-auto"></div>
            </div>

            <!-- Categories -->
            <div class="flex flex-wrap justify-center gap-3 mb-12">
                <x-ui.button variant="primary" size="sm" class="rounded-full">
                    {{ __('All Pizzas') }}
                </x-ui.button>
                @foreach($categories as $category)
                    <x-ui.button variant="outline" size="sm" class="rounded-full !text-gray-500 !border-gray-100 hover:!text-white">
                        {{ $category->name }}
                    </x-ui.button>
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
