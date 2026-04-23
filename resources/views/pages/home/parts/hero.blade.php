<div class="relative overflow-hidden pt-4 pb-12"
    style="background-color: #ffffff; background-image: radial-gradient(#d1d5db 1.5px, transparent 1.5px); background-size: 40px 40px;">

    <!-- LARGE BACKGROUND GLOBS (Outside the banner) -->
    <div
        class="absolute top-0 left-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/2">
    </div>

    <div
        class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-secondary/5 rounded-full blur-[130px] translate-x-1/3 translate-y-1/3">
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Compact Hero Banner Section -->
        <div
            class="relative bg-[#fdfaf3]/90 backdrop-blur-sm rounded-[40px] overflow-hidden mb-6 border border-gray-100 shadow-sm">

            <!-- INNER GLOBS -->
            <div class="absolute top-[-10%] right-[-10%] w-64 h-64 bg-primary/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-80 h-80 bg-secondary/10 rounded-full blur-3xl"></div>

            <div class="flex flex-col md:flex-row items-center justify-between px-10 py-10 md:py-16 relative z-10">
                <div class="md:w-1/2 mb-8 md:mb-0 relative z-10">
                    <div class="absolute -top-10 -left-10 w-20 h-20 bg-primary/5 rounded-full blur-xl animate-pulse">
                    </div>

                    <h1
                        class="text-5xl md:text-6xl font-black text-gray-900 leading-[0.85] mb-4 font-heading uppercase tracking-tighter">
                        Artesanal <br>
                        <span class="text-primary italic">Flavor</span> for your <br>
                        convenience
                    </h1>
                    <p class="text-base text-gray-500 mb-6 max-w-sm font-medium leading-snug">
                        Handcrafted with passion, fresh ingredients, and delivered straight to your door.
                    </p>

                    <div class="relative inline-block group">
                        <div
                            class="absolute -inset-1 bg-primary/20 rounded-xl blur opacity-0 group-hover:opacity-100 transition-opacity">
                        </div>
                        <a href="#menu"
                            class="relative z-10 bg-primary text-white px-8 py-3.5 rounded-xl font-bold text-base hover:scale-105 active:scale-95 transition-all shadow-xl shadow-red-900/20 inline-block">
                            Order Now
                        </a>
                    </div>
                </div>

                <div class="md:w-1/2 relative flex justify-center">
                    <div class="absolute inset-0 bg-primary/10 rounded-full blur-3xl transform scale-75 animate-pulse">
                    </div>
                    <!-- Floating Accents around Pizza -->
                    <div class="absolute top-0 right-0 w-4 h-4 bg-primary/20 rounded-full animate-bounce delay-100">
                    </div>
                    <div class="absolute bottom-10 left-0 w-3 h-3 bg-secondary/30 rounded-full animate-bounce"></div>

                    <img src="{{ asset('storage/pizzas/margherita.png') }}" alt="Featured Pizza"
                        class="relative z-10 w-full max-w-xs h-auto drop-shadow-[0_20px_20px_rgba(0,0,0,0.15)] animate-float">
                </div>
            </div>

            <!-- Dots -->
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2 z-20">
                <div class="w-6 h-1.5 bg-primary rounded-full"></div>
                <div class="w-1.5 h-1.5 bg-gray-200 rounded-full"></div>
                <div class="w-1.5 h-1.5 bg-gray-200 rounded-full"></div>
            </div>
        </div>

        <!-- Featured Products -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 relative z-10">
            @foreach($featuredPizzas as $pizza)
                <x-mini-product-card :pizza="$pizza" />
            @endforeach
        </div>
    </div>
</div>