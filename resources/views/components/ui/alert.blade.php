@props([
    'type' => 'success',
    'message' => null,
    'dismissible' => true,
    'timeout' => 5000
])

@php
    $types = [
        'success' => [
            'bg' => 'bg-emerald-500/95',
            'icon' => 'fas-check-circle',
            'text' => 'text-white',
            'border' => 'border-emerald-400/20'
        ],
        'error' => [
            'bg' => 'bg-red-500/95',
            'icon' => 'fas-exclamation-circle',
            'text' => 'text-white',
            'border' => 'border-red-400/20'
        ],
        'info' => [
            'bg' => 'bg-blue-500/95',
            'icon' => 'fas-info-circle',
            'text' => 'text-white',
            'border' => 'border-blue-400/20'
        ]
    ];

    $style = $types[$type] ?? $types['success'];
@endphp

<div 
    x-data="{ 
        show: {{ $message || $slot->isNotEmpty() ? 'true' : 'false' }},
        message: '{{ $message ?? $slot }}',
        type: '{{ $type }}',
        progress: 100,
        
        init() {
            if (this.show) {
                this.startTimer();
            }
            
            // Listen for global notify events
            window.addEventListener('notify', (event) => {
                this.show = true;
                this.message = event.detail.message;
                this.type = event.detail.type || 'success';
                this.progress = 100;
                this.startTimer();
            });
        },

        startTimer() {
            if ({{ $timeout }} > 0) {
                let interval = 50;
                let step = (interval / {{ $timeout }}) * 100;
                if (this.timer) clearInterval(this.timer);
                this.timer = setInterval(() => {
                    this.progress -= step;
                    if (this.progress <= 0) {
                        this.show = false;
                        clearInterval(this.timer);
                    }
                }, interval);
            }
        },

        getStyle() {
            const types = @js($types);
            return types[this.type] || types['success'];
        }
    }"
    x-show="show"
    x-cloak
    x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0 -translate-y-12 scale-90"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90"
    class="fixed top-10 left-1/2 -translate-x-1/2 z-[9999] w-full max-w-md px-4"
>
    <div :class="getStyle().bg + ' ' + getStyle().text" class="backdrop-blur-xl border rounded-[30px] p-5 shadow-2xl shadow-black/10 relative overflow-hidden group" :class="getStyle().border">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-white/20 rounded-2xl flex items-center justify-center flex-shrink-0">
                <template x-if="type === 'success'">@svg('fas-check-circle', ['class' => 'w-5 h-5'])</template>
                <template x-if="type === 'error'">@svg('fas-exclamation-circle', ['class' => 'w-5 h-5'])</template>
                <template x-if="type === 'info'">@svg('fas-info-circle', ['class' => 'w-5 h-5'])</template>
            </div>
            
            <div class="flex-1">
                <h4 class="text-[9px] font-black uppercase tracking-[0.2em] opacity-70 mb-1" x-text="type"></h4>
                <p class="text-sm font-bold leading-tight" x-text="message"></p>
            </div>

            @if($dismissible)
                <button @click="show = false" class="p-2 hover:bg-white/10 rounded-xl transition-colors">
                    @svg('fas-times', ['class' => 'w-4 h-4'])
                </button>
            @endif
        </div>

        <!-- Progress Bar -->
        @if($timeout > 0)
            <div class="absolute bottom-0 left-0 h-1 bg-white/30" :style="'width: ' + progress + '%'"></div>
        @endif
    </div>
</div>
