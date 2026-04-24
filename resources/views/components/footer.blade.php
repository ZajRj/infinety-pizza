<footer class="bg-gray-900 text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            <div class="col-span-1 md:col-span-2">
                <span class="text-3xl font-black text-brand-primary tracking-tighter font-heading uppercase italic mb-6 block">
                    Infinety <span class="text-white not-italic">Pizza</span>
                </span>
                <p class="text-gray-400 max-w-sm mb-6">
                    {{ __('Bringing the taste of real artisanal pizza to your table. Fresh ingredients, sourdough, and lots of passion in every slice.') }}
                </p>
                <div class="flex gap-4">
                    <!-- Social icons would go here -->
                </div>
            </div>

            <div>
                <h4 class="text-lg font-bold mb-6 font-heading uppercase tracking-wider">{{ __('Explore') }}</h4>
                <ul class="space-y-4 text-gray-400 text-sm">
                    <li><a href="{{ route('home') }}#menu" class="hover:text-brand-primary transition-colors">{{ __('Menu') }}</a></li>
                    <li><a href="{{ route('home') }}#menu" class="hover:text-brand-primary transition-colors">{{ __('Promotions') }}</a></li>
                    <li><a href="{{ route('home') }}#locations" class="hover:text-brand-primary transition-colors">{{ __('Locations') }}</a></li>
                    <li><a href="https://wa.me/584244289888" target="_blank" class="hover:text-brand-primary transition-colors">{{ __('Contact') }}</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-bold mb-6 font-heading uppercase tracking-wider">{{ __('Legal') }}</h4>
                <ul class="space-y-4 text-gray-400 text-sm">
                    <li><a href="#" class="hover:text-brand-primary transition-colors">{{ __('Terms & Conditions') }}</a></li>
                    <li><a href="#" class="hover:text-brand-primary transition-colors">{{ __('Privacy') }}</a></li>
                    <li><a href="#" class="hover:text-brand-primary transition-colors">{{ __('Cookies') }}</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-gray-500 text-[10px] font-bold uppercase tracking-widest">
                &copy; {{ date('Y') }} Infinety Pizza. {{ __('All rights reserved.') }}
            </p>
            <p class="text-gray-500 text-[10px] font-bold uppercase tracking-widest flex items-center gap-1">
                {{ __('Made with ❤️ for pizza lovers.') }} by ZajRj
            </p>
        </div>
    </div>
</footer>
