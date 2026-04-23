<section id="about" class="py-24 bg-white relative overflow-hidden">
    <!-- Decorative Accents -->
    <div class="absolute top-1/2 left-0 w-64 h-64 bg-primary/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute top-1/4 right-0 w-96 h-96 bg-secondary/5 rounded-full blur-[100px] translate-x-1/3"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            
            <!-- Left: Visual Storytelling -->
            <div class="lg:w-1/2 relative">
                <!-- Main Image Container -->
                <div class="relative rounded-[40px] overflow-hidden border-8 border-white shadow-2xl shadow-gray-200/50 group">
                    <img src="{{ asset('storage/brand/story.png') }}" alt="Artisanal Pizza Making" class="w-full h-[500px] object-cover transition-transform duration-700 group-hover:scale-105">
                    
                    <!-- Overlay Badge -->
                    <div class="absolute bottom-10 left-10 bg-white/90 backdrop-blur-md p-6 rounded-3xl border border-white/50 shadow-xl max-w-xs transition-transform group-hover:-translate-y-2">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="bg-primary p-2 rounded-xl">
                                @svg('fas-award', ['class' => 'w-6 h-6 text-white'])
                            </div>
                            <span class="font-black text-gray-900 uppercase tracking-tighter text-sm">{{ __('Best Artisanal Pizza 2024') }}</span>
                        </div>
                        <p class="text-xs text-gray-500 leading-relaxed font-medium">
                            {{ __('Recognized for our commitment to 48-hour fermented dough and locally sourced ingredients.') }}
                        </p>
                    </div>
                </div>

                <!-- Floating Decorative Element -->
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-brand-neutral rounded-[40px] border border-gray-100 shadow-lg flex items-center justify-center -rotate-12 animate-float">
                    <div class="text-center">
                        <span class="block text-3xl font-black text-primary leading-none italic">48h</span>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ __('Fermentation') }}</span>
                    </div>
                </div>
            </div>

            <!-- Right: The Narrative -->
            <div class="lg:w-1/2">
                <span class="inline-block px-4 py-1.5 rounded-full bg-primary/10 text-primary text-[10px] font-black uppercase tracking-widest mb-6">
                    {{ __('Our Story') }}
                </span>
                
                <h2 class="text-4xl md:text-6xl font-black text-gray-900 mb-8 font-heading uppercase tracking-tighter leading-[0.9]">
                    {{ __('Passion in') }} <br>
                    {{ __('every') }} <span class="text-primary italic">{{ __('crust') }}</span>
                </h2>

                <div class="space-y-6 text-lg text-gray-500 leading-relaxed font-medium">
                    <p>
                        {{ __('Infinety Pizza Co. started with a simple belief:') }} <span class="text-gray-900 font-bold italic">{{ __("great pizza shouldn't be a luxury, but an experience.") }}</span> {{ __('We spent years perfecting a dough that is light, airy, and full of flavor.') }}
                    </p>
                    <p>
                        {{ __('Our secret? Time. Every single dough ball we produce is fermented for exactly 48 hours in our temperature-controlled cellars, ensuring the perfect texture that only patience can provide.') }}
                    </p>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-2 gap-8 mt-12">
                    <div>
                        <span class="block text-4xl font-black text-gray-900 font-heading tracking-tighter">100%</span>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ __('Natural Ingredients') }}</span>
                    </div>
                    <div>
                        <span class="block text-4xl font-black text-gray-900 font-heading tracking-tighter">15+</span>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ __('Signature Recipes') }}</span>
                    </div>
                </div>

                <div class="mt-12 flex items-center gap-6">
                    <x-ui.button href="#menu" variant="dark" size="lg">
                        {{ __('Explore Our Menu') }}
                    </x-ui.button>
                    <div class="flex items-center gap-3">
                        <div class="flex -space-x-3">
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-gray-100 flex items-center justify-center text-[10px] font-bold text-gray-400 overflow-hidden">
                                <img src="https://ui-avatars.com/api/?name=JS&background=random" alt="User">
                            </div>
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-gray-100 flex items-center justify-center text-[10px] font-bold text-gray-400 overflow-hidden">
                                <img src="https://ui-avatars.com/api/?name=MD&background=random" alt="User">
                            </div>
                        </div>
                        <span class="text-xs font-bold text-gray-400">{{ __('Join hundreds of happy pizza lovers') }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
