<nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            
            <!-- Left: Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <span class="text-xl font-bold text-brand-primary tracking-tight font-heading">
                        Infinety <span class="text-gray-900 group-hover:text-brand-primary transition-colors">Pizza Co.</span>
                    </span>
                </a>
            </div>

            <!-- Center: Navigation Links -->
            <div class="hidden sm:flex items-center justify-center space-x-10 flex-1">
                <a href="{{ route('home') }}#hero" data-nav-link="hero" class="nav-link text-sm font-semibold text-brand-primary border-b-2 border-brand-primary pb-1 transition-all">Home</a>
                <a href="{{ route('home') }}#menu" data-nav-link="menu" class="nav-link text-sm font-semibold text-gray-500 hover:text-gray-900 border-b-2 border-transparent pb-1 transition-all">Menu</a>
                <a href="{{ route('home') }}#about" data-nav-link="about" class="nav-link text-sm font-semibold text-gray-500 hover:text-gray-900 border-b-2 border-transparent pb-1 transition-all">Our Story</a>
                <a href="{{ route('home') }}#locations" data-nav-link="locations" class="nav-link text-sm font-semibold text-gray-500 hover:text-gray-900 border-b-2 border-transparent pb-1 transition-all">Locations</a>
            </div>

            <!-- Right: Actions -->
            <div class="flex items-center space-x-6">
                <!-- Cart -->
                <a href="/cart" class="text-gray-700 hover:text-brand-primary transition-colors relative">
                    @svg('fas-shopping-cart', ['class' => 'w-5 h-5'])
                    <span class="absolute -top-2 -right-2 bg-brand-primary text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">0</span>
                </a>

                @auth
                    @if(auth()->user()->is_admin)
                        <a href="/admin" class="hidden lg:block text-[10px] font-black text-tertiary uppercase tracking-widest hover:opacity-70 transition-opacity">
                            Admin
                        </a>
                    @endif
                    <a href="{{ route('profile') }}" class="text-[10px] font-black text-gray-900 uppercase tracking-widest hover:text-primary transition-colors">
                        Profile
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-primary transition-colors">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-brand-primary transition-colors">
                        @svg('far-user-circle', ['class' => 'w-5 h-5'])
                    </a>
                @endauth

                <!-- Order Button -->
                <a href="{{ route('home') }}#menu" class="hidden sm:block bg-primary text-white px-6 py-2.5 rounded-full text-sm font-bold shadow-lg shadow-brand-primary/20 hover:scale-105 active:scale-95 transition-all">
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
