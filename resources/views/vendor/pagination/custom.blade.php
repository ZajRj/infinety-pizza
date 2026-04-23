@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center space-x-2">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-50 text-gray-300 cursor-not-allowed border border-gray-100">
                @svg('fas-chevron-left', ['class' => 'w-3 h-3'])
            </span>
        @else
            <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white text-gray-500 border border-gray-100 hover:border-primary hover:text-primary transition-all shadow-sm active:scale-95">
                @svg('fas-chevron-left', ['class' => 'w-3 h-3'])
            </button>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="px-2 text-gray-400 font-black tracking-widest text-[10px]">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-primary text-white font-black text-xs shadow-lg shadow-red-900/20 z-10">
                            {{ $page }}
                        </span>
                    @else
                        <button wire:click="gotoPage({{ $page }})" wire:loading.attr="disabled" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white text-gray-500 font-black text-xs border border-gray-100 hover:border-primary/20 hover:text-primary transition-all shadow-sm active:scale-95">
                            {{ $page }}
                        </button>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white text-gray-500 border border-gray-100 hover:border-primary hover:text-primary transition-all shadow-sm active:scale-95">
                @svg('fas-chevron-right', ['class' => 'w-3 h-3'])
            </button>
        @else
            <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-50 text-gray-300 cursor-not-allowed border border-gray-100">
                @svg('fas-chevron-right', ['class' => 'w-3 h-3'])
            </span>
        @endif
    </nav>
@endif
