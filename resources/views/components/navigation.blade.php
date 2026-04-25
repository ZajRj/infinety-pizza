<nav x-data="{ mobileMenuOpen: false }" class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">

            <!-- Left: Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <span class="text-xl font-bold text-brand-primary tracking-tight font-heading uppercase italic">
                        Infinety <span
                            class="text-gray-900 group-hover:text-brand-primary transition-colors not-italic">Pizza</span>
                    </span>
                </a>
            </div>

            <!-- Center: Navigation Links (Desktop) -->
            <div class="hidden md:flex items-center justify-center space-x-10 flex-1 px-8">
                <a href="{{ route('home') }}#hero" data-nav-link="hero"
                    class="nav-link text-[10px] font-black text-gray-400 hover:text-primary uppercase tracking-[0.2em] transition-all border-b-2 border-transparent pb-1">{{ __('Home') }}</a>
                <a href="{{ route('home') }}#menu" data-nav-link="menu"
                    class="nav-link text-[10px] font-black text-gray-400 hover:text-primary uppercase tracking-[0.2em] transition-all border-b-2 border-transparent pb-1">{{ __('Menu') }}</a>
                <a href="{{ route('home') }}#about" data-nav-link="about"
                    class="nav-link text-[10px] font-black text-gray-400 hover:text-primary uppercase tracking-[0.2em] transition-all border-b-2 border-transparent pb-1">{{ __('Our Story') }}</a>
                <a href="{{ route('home') }}#locations" data-nav-link="locations"
                    class="nav-link text-[10px] font-black text-gray-400 hover:text-primary uppercase tracking-[0.2em] transition-all border-b-2 border-transparent pb-1">{{ __('Locations') }}</a>
            </div>

            <!-- Right: Actions -->
            <div class="flex items-center space-x-4">
                <!-- Cart (Desktop Only) -->
                <button @click="$dispatch('pizza:toggle-cart')"
                    class="hidden cursor-pointer md:flex text-gray-700 hover:text-brand-primary transition-colors relative p-2">
                    @svg('fas-shopping-cart', ['class' => 'w-5 h-5'])
                    <span x-data="{ count: {{ count(Session::get('cart', [])) }} }"
                        x-on:cart-updated.window="count = $event.detail.count || 0" x-text="count"
                        class="absolute -top-1.5 -right-1.5 bg-red-600 text-white text-[11px] leading-none font-black px-1.5 py-0.5 rounded-full ring-2 ring-white shadow-md z-20"></span>
                </button>

                @auth
                    <div class="hidden md:flex items-center space-x-3">
                        @if(auth()->user()->is_admin)
                            <x-ui.button href="/admin" variant="tertiary" size="sm">
                                {{ __('Admin') }}
                            </x-ui.button>
                        @endif
                        <x-ui.button :href="route('profile')" variant="white" size="sm">
                            {{ __('Profile') }}
                        </x-ui.button>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <x-ui.button type="submit" variant="white" size="sm" class="!text-gray-400">
                                {{ __('Logout') }}
                            </x-ui.button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="hidden md:flex text-gray-700 hover:text-brand-primary transition-colors">
                        @svg('far-user-circle', ['class' => 'w-5 h-5'])
                    </a>
                @endauth

                <!-- Order Button (Desktop Only) -->
                <div class="hidden md:block">
                    <x-ui.button :href="route('home') . '#menu'" variant="primary" size="sm">
                        {{ __('Order Now') }}
                    </x-ui.button>
                </div>

                <!-- Cart (Mobile Only) -->
                <button @click="$dispatch('pizza:toggle-cart')"
                    class="md:hidden flex text-gray-700 hover:text-brand-primary transition-colors relative p-2">
                    @svg('fas-shopping-cart', ['class' => 'w-5 h-5'])
                    <span x-data="{ count: {{ count(Session::get('cart', [])) }} }"
                        x-on:cart-updated.window="count = $event.detail.count || 0" x-text="count"
                        class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] font-black px-1.5 py-0.5 rounded-full ring-2 ring-white shadow-sm z-20"></span>
                </button>

                <!-- Hamburger Button (Mobile Only) -->
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="md:hidden p-2 text-gray-900 focus:outline-none">
                    <template x-if="!mobileMenuOpen">
                        @svg('fas-bars', ['class' => 'w-6 h-6'])
                    </template>
                    <template x-if="mobileMenuOpen">
                        @svg('fas-times', ['class' => 'w-6 h-6'])
                    </template>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="md:hidden bg-white border-b border-gray-100 shadow-xl overflow-hidden" style="display: none;">
        <div class="px-4 pt-4 pb-8 space-y-2">
            <a href="{{ route('home') }}#hero" data-nav-link="hero" @click="mobileMenuOpen = false"
                class="nav-link block px-4 py-3 rounded-2xl text-sm font-black text-gray-900 uppercase tracking-widest hover:bg-brand-neutral">{{ __('Home') }}</a>
            <a href="{{ route('home') }}#menu" data-nav-link="menu" @click="mobileMenuOpen = false"
                class="nav-link block px-4 py-3 rounded-2xl text-sm font-black text-gray-900 uppercase tracking-widest hover:bg-brand-neutral">{{ __('Menu') }}</a>
            <a href="{{ route('home') }}#about" data-nav-link="about" @click="mobileMenuOpen = false"
                class="nav-link block px-4 py-3 rounded-2xl text-sm font-black text-gray-900 uppercase tracking-widest hover:bg-brand-neutral">{{ __('Our Story') }}</a>
            <a href="{{ route('home') }}#locations" data-nav-link="locations" @click="mobileMenuOpen = false"
                class="nav-link block px-4 py-3 rounded-2xl text-sm font-black text-gray-900 uppercase tracking-widest hover:bg-brand-neutral">{{ __('Locations') }}</a>

            <div class="pt-4 mt-4 border-t border-gray-50 space-y-4">
                @auth
                    <div class="flex flex-col gap-3">
                        <x-ui.button :href="route('profile')" variant="dark" fullWidth>
                            {{ __('Go to Profile') }}
                        </x-ui.button>
                        @if(auth()->user()->is_admin)
                            <x-ui.button href="/admin" variant="tertiary" fullWidth>
                                {{ __('Admin Panel') }}
                            </x-ui.button>
                        @endif
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <x-ui.button type="submit" variant="white" fullWidth>
                                {{ __('Sign Out') }}
                            </x-ui.button>
                        </form>
                    </div>
                @else
                    <div class="flex flex-col gap-3">
                        <x-ui.button :href="route('login')" variant="primary" fullWidth>
                            {{ __('Sign In') }}
                        </x-ui.button>
                        <x-ui.button :href="route('register')" variant="outline" fullWidth>
                            {{ __('Create Account') }}
                        </x-ui.button>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sections = document.querySelectorAll('section[id], div[id="hero"]');
            const navLinks = document.querySelectorAll('.nav-link');

            const activeClasses = ['text-primary', 'border-primary'];
            const inactiveClasses = ['text-gray-400', 'border-transparent'];

            const observerOptions = {
                root: null,
                rootMargin: '-20% 0px -70% 0px',
                threshold: 0
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const id = entry.target.getAttribute('id');
                        navLinks.forEach(link => {
                            if (link.getAttribute('data-nav-link') === id) {
                                link.classList.add(...activeClasses);
                                link.classList.remove(...inactiveClasses);
                            } else if (link.hasAttribute('data-nav-link')) {
                                link.classList.remove(...activeClasses);
                                link.classList.add(...inactiveClasses);
                            }
                        });
                    }
                });
            }, observerOptions);

            sections.forEach(section => observer.observe(section));
        });
    </script>
</nav>