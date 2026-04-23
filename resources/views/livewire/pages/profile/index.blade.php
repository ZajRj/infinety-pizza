<div class="bg-brand-neutral min-h-screen py-12 md:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col lg:flex-row gap-12 items-start">
            
            <!-- Left Column: User Profile Sidebar -->
            <div class="lg:w-1/3 w-full sticky top-32">
                <div class="bg-white rounded-[40px] p-10 border border-gray-100 shadow-xl shadow-gray-200/20 relative overflow-hidden">
                    <!-- Top Decorative Blob -->
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-primary/5 rounded-full blur-3xl"></div>

                    <div class="relative z-10 text-center mb-10">
                        <div class="w-32 h-32 rounded-full border-4 border-white shadow-xl shadow-gray-200/50 mx-auto mb-6 overflow-hidden bg-brand-neutral flex items-center justify-center">
                            @svg('fas-user', ['class' => 'w-12 h-12 text-gray-200'])
                        </div>
                        <h2 class="text-3xl font-black text-gray-900 font-heading uppercase tracking-tighter leading-none mb-2">{{ $user->name }}</h2>
                        <p class="text-[10px] font-black text-primary uppercase tracking-[0.3em]">
                            {{ $user->is_admin ? 'Master Chef & Admin' : 'Artisanal Connoisseur' }}
                        </p>
                    </div>

                    <div class="space-y-8 mb-12">
                        <div>
                            <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 border-b border-gray-50 pb-2">Contact Info</h4>
                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <div class="text-primary opacity-50">@svg('fas-envelope', ['class' => 'w-3 h-3'])</div>
                                    <p class="text-xs font-bold text-gray-700">{{ $user->email }}</p>
                                </div>
                                @if($user->phone_number)
                                    <div class="flex items-center gap-3">
                                        <div class="text-primary opacity-50">@svg('fas-phone', ['class' => 'w-3 h-3'])</div>
                                        <p class="text-xs font-bold text-gray-700">{{ $user->phone_number }}</p>
                                    </div>
                                @endif
                                @if($user->dni)
                                    <div class="flex items-center gap-3">
                                        <div class="text-primary opacity-50">@svg('fas-id-card', ['class' => 'w-3 h-3'])</div>
                                        <p class="text-xs font-bold text-gray-700">DNI: {{ $user->dni }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div>
                            <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 border-b border-gray-50 pb-2">Primary Address</h4>
                            <div class="flex items-start gap-3">
                                <div class="text-primary opacity-50 pt-1">@svg('fas-map-marker-alt', ['class' => 'w-3 h-3'])</div>
                                <p class="text-xs font-bold text-gray-700 leading-relaxed">
                                    {{ $user->address ?? 'No address registered yet.' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <x-ui.button variant="dark" icon="fas-edit" fullWidth>
                        Edit Profile
                    </x-ui.button>
                    
                    <form action="{{ route('logout') }}" method="POST" class="mt-4">
                        @csrf
                        <x-ui.button type="submit" variant="white" fullWidth>
                            Sign Out
                        </x-ui.button>
                    </form>
                </div>
            </div>

            <!-- Right Column: Activity & Orders -->
            <div class="lg:w-2/3 w-full">
                <!-- Stats Overview -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-12">
                    <div class="bg-white p-8 rounded-[32px] border border-gray-100 shadow-lg shadow-gray-200/10 text-center">
                        <p class="text-3xl font-black text-gray-900 font-heading">{{ $user->orders()->count() }}</p>
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mt-1">Total Orders</p>
                    </div>
                    <div class="bg-white p-8 rounded-[32px] border border-gray-100 shadow-lg shadow-gray-200/10 text-center">
                        <p class="text-3xl font-black text-primary font-heading italic">{{ number_format($totalSpend, 2) }}€</p>
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mt-1">Life Spend</p>
                    </div>
                  
                </div>

                <!-- Order History -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-black text-gray-900 font-heading uppercase tracking-tighter">Recent Orders</h2>
                        @if($orders->count() > 0)
                            <a href="#" class="text-[10px] font-black text-primary uppercase tracking-widest hover:underline">View All</a>
                        @endif
                    </div>
                    
                    <div class="space-y-6">
                        @forelse($orders as $order)
                            <div class="bg-white rounded-[40px] p-8 border border-gray-100 shadow-xl shadow-gray-200/20 group hover:border-primary/20 transition-all">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                                    <div class="flex items-center gap-6">
                                        <div class="w-16 h-16 bg-brand-neutral rounded-2xl flex items-center justify-center text-primary border border-gray-50 group-hover:scale-110 transition-transform">
                                            @svg('fas-receipt', ['class' => 'w-6 h-6'])
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-3 mb-1">
                                                <h3 class="text-lg font-black text-gray-900 font-heading uppercase tracking-tight">Order #{{ $order->id }}</h3>
                                                <span class="px-3 py-1 bg-tertiary/10 text-tertiary text-[8px] font-black uppercase tracking-widest rounded-full">
                                                    {{ $order->status->label() ?? 'Processing' }}
                                                </span>
                                            </div>
                                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">
                                                {{ $order->created_at->format('M d, Y • H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-8 justify-between md:justify-end">
                                        <div class="text-right">
                                            <p class="text-[9px] font-black text-gray-300 uppercase tracking-widest">Amount</p>
                                            <p class="text-xl font-black text-primary italic leading-none">{{ number_format($order->total, 2) }}€</p>
                                        </div>
                                        <button class="bg-brand-neutral p-4 rounded-2xl text-gray-900 hover:bg-primary hover:text-white transition-all shadow-sm">
                                            @svg('fas-chevron-right', ['class' => 'w-4 h-4'])
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white/50 rounded-[40px] p-12 border border-dashed border-gray-200 text-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                                    @svg('fas-pizza-slice', ['class' => 'w-6 h-6'])
                                </div>
                                <h3 class="text-lg font-black text-gray-900 font-heading uppercase tracking-tight mb-2">No orders yet</h3>
                                <p class="text-xs font-medium text-gray-400 mb-6">Your pizza journey starts here. Explore our menu!</p>
                                <x-ui.button :href="route('home') . '#menu'" variant="primary" size="md">
                                    Order Now
                                </x-ui.button>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
