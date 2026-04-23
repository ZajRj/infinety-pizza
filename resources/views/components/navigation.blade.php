<nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            
            <!-- Left: Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="/" class="flex items-center gap-2 group">
                    <span class="text-xl font-bold text-brand-primary tracking-tight font-heading">
                        Infinety <span class="text-gray-900 group-hover:text-brand-primary transition-colors">Pizza Co.</span>
                    </span>
                </a>
            </div>

            <!-- Center: Navigation Links -->
            <div class="hidden sm:flex items-center justify-center space-x-10 flex-1">
                <a href="#hero" class="text-sm font-semibold text-brand-primary border-b-2 border-brand-primary pb-1 transition-all">Home</a>
                <a href="#menu" class="text-sm font-semibold text-gray-500 hover:text-gray-900 border-b-2 border-transparent pb-1 transition-all">Menu</a>
                <a href="#about" class="text-sm font-semibold text-gray-500 hover:text-gray-900 border-b-2 border-transparent pb-1 transition-all">Our Story</a>
                <a href="#locations" class="text-sm font-semibold text-gray-500 hover:text-gray-900 border-b-2 border-transparent pb-1 transition-all">Locations</a>
            </div>

            <!-- Right: Actions -->
            <div class="flex items-center space-x-6">
                <!-- Cart -->
                <a href="/cart" class="text-gray-700 hover:text-brand-primary transition-colors relative">
                    @svg('fas-shopping-cart', ['class' => 'w-5 h-5'])
                    <span class="absolute -top-2 -right-2 bg-brand-primary text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">0</span>
                </a>

                <!-- User -->
                <a href="{{ auth()->check() ? '/admin' : '/login' }}" class="text-gray-700 hover:text-brand-primary transition-colors">
                    @svg('far-user-circle', ['class' => 'w-5 h-5'])
                </a>

                <!-- Order Button -->
                <a href="#todo" class="hidden sm:block bg-primary text-white px-6 py-2.5 rounded-full text-sm font-bold shadow-lg shadow-brand-primary/20 hover:scale-105 active:scale-95 transition-all">
                    Order Now
                </a>

                <!-- Mobile menu button (optional) -->
                <button class="sm:hidden text-gray-700">
                    @svg('fas-bars', ['class' => 'w-6 h-6'])
                </button>
            </div>

        </div>
    </div>
</nav>
