<div
    x-data="cartDrawer({ items: @js($items), total: @js($total) })"
    @pizza:add-to-cart.window="addItem($event.detail)"
    @pizza:toggle-cart.window="toggle()"
    class="relative z-[100]"
>
    <!-- Overlay -->
    <div 
        x-show="open" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="open = false" 
        class="fixed inset-0 bg-black/40 backdrop-blur-sm"
    ></div>

    <!-- Drawer Panel -->
    <div 
        x-show="open"
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-400"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed inset-y-0 right-0 w-full sm:w-[450px] bg-white shadow-2xl flex flex-col z-[101]"
        @click.away="open = false"
        x-cloak
    >
        <!-- Header -->
        <div class="p-8 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-black text-gray-900 font-heading uppercase tracking-tighter mb-1">{{ __('Your Order') }}</h2>
                <p class="text-[10px] font-black text-primary uppercase tracking-[0.2em]" x-text="`${items.length} {{ __('Pizzas Selected') }}`"></p>
            </div>
            <button @click="open = false" class="w-12 h-12 flex items-center justify-center rounded-2xl bg-brand-neutral text-gray-900 hover:bg-primary hover:text-white transition-all shadow-sm group">
                @svg('fas-times', ['class' => 'w-5 h-5 group-hover:rotate-90 transition-transform'])
            </button>
        </div>

        <!-- Cart Items -->
        <div class="flex-1 overflow-y-auto p-8 space-y-6 custom-scrollbar">
            <template x-if="items.length === 0">
                <div class="h-full flex flex-col items-center justify-center text-center px-4">
                    <div class="w-24 h-24 bg-brand-neutral rounded-full flex items-center justify-center text-gray-300 mb-6">
                        @svg('fas-pizza-slice', ['class' => 'w-10 h-10'])
                    </div>
                    <h3 class="text-xl font-black text-gray-900 font-heading uppercase tracking-tight mb-2">{{ __('Cart is empty') }}</h3>
                    <p class="text-xs font-medium text-gray-400 max-w-[200px]">{{ __('Your artisanal journey starts when you add a pizza!') }}</p>
                </div>
            </template>

            <template x-for="item in items" :key="item.id">
                <div class="bg-brand-neutral/30 rounded-[32px] p-5 border border-gray-50 group hover:bg-white hover:shadow-xl hover:shadow-gray-200/20 transition-all">
                    <div class="flex gap-5">
                        <div class="w-20 h-20 rounded-2xl overflow-hidden flex-shrink-0 border border-gray-100 bg-white">
                            <img :src="`/storage/${item.image}`" :alt="item.name" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="text-sm font-black text-gray-900 uppercase tracking-tight leading-tight" x-text="item.name"></h4>
                                <button @click="remove(item.id)" :disabled="loading" class="text-gray-300 hover:text-primary transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                    @svg('fas-trash-alt', ['class' => 'w-3 h-3'])
                                </button>
                            </div>
                            <div class="flex items-center justify-between mt-4">
                                <div class="flex items-center bg-white rounded-xl p-1 border border-gray-100 shadow-sm" :class="{ 'opacity-50': loading }">
                                    <button @click="decrease(item.id)" :disabled="loading" class="w-7 h-7 flex items-center justify-center rounded-lg hover:bg-brand-neutral font-bold transition-all disabled:cursor-not-allowed">-</button>
                                    <span class="w-8 text-center font-black text-gray-900 text-xs" x-text="item.quantity"></span>
                                    <button @click="increase(item.id)" :disabled="loading" class="w-7 h-7 flex items-center justify-center rounded-lg hover:bg-brand-neutral font-bold transition-all disabled:cursor-not-allowed">+</button>
                                </div>
                                <span class="text-sm font-black text-primary italic" x-text="`${(item.price * item.quantity).toFixed(2)}€` "></span>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Footer -->
        <div class="p-8 bg-brand-neutral/50 border-t border-gray-100 space-y-6">
            <div class="flex justify-between items-end">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1">{{ __('Order Summary') }}</p>
                    <p class="text-4xl font-black text-gray-900 font-heading tracking-tighter" x-text="`${total.toFixed(2)}€`"></p>
                </div>
                <div class="text-right flex items-center gap-1">
                    <p class="text-[9px] font-medium text-gray-400 uppercase tracking-[0.2em] mb-1">{{ __('Delivery') }}</p>
                     <p class="text-[9px] font-black text-emerald-500 uppercase tracking-widest bg-emerald-500/10 px-3 py-1 rounded-full">{{ __('FREE') }}</p>
                </div>
            </div>

            <template x-if="items.length > 0">
                <a href="{{ route('checkout') }}" 
                   :class="{ 'opacity-50 pointer-events-none': loading }"
                   class="w-full bg-primary text-white py-5 rounded-[25px] font-black text-sm uppercase tracking-[0.2em] shadow-2xl shadow-red-900/30 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-4 group">
                    <template x-if="!loading">
                        <div class="flex items-center gap-4">
                            @svg('fas-shopping-bag', ['class' => 'w-4 h-4 group-hover:-translate-y-1 transition-transform'])
                            {{ __('Go to Checkout') }}
                        </div>
                    </template>
                    <template x-if="loading">
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></div>
                            <span>{{ __('Processing...') }}</span>
                        </div>
                    </template>
                </a>
            </template>
            
            <button @click="open = false" class="w-full text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-gray-900 transition-colors">
                {{ __('Continue Shopping') }}
            </button>
        </div>
    </div>
</div>
