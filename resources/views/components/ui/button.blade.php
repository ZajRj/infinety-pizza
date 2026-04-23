@props([
    'variant' => 'primary', // primary, secondary, tertiary, dark, white, outline
    'size' => 'md',      // sm, md, lg
    'href' => null,
    'icon' => null,
    'fullWidth' => false,
    'type' => 'button'
])

@php
    $baseStyles = "inline-flex items-center justify-center gap-3 font-black uppercase tracking-[0.2em] transition-all active:scale-95 disabled:opacity-50 disabled:pointer-events-none rounded-2xl";
    
    $variants = [
        'primary'   => 'bg-primary text-white shadow-xl shadow-red-900/20 hover:scale-[1.02] hover:bg-red-700',
        'secondary' => 'bg-secondary text-white shadow-xl shadow-orange-900/10 hover:scale-[1.02]',
        'tertiary'  => 'bg-tertiary text-white shadow-xl shadow-emerald-900/10 hover:scale-[1.02]',
        'dark'      => 'bg-gray-900 text-white shadow-xl shadow-gray-900/10 hover:bg-primary',
        'white'     => 'bg-white text-gray-400 hover:text-primary shadow-sm',
        'outline'   => 'bg-transparent border-2 border-gray-100 text-gray-900 hover:bg-primary hover:text-white hover:border-primary',
    ];

    $sizes = [
        'sm' => 'px-4 py-2 text-[10px]',
        'md' => 'px-6 py-4 text-[10px]',
        'lg' => 'px-8 py-5 text-sm',
    ];

    $classes = "{$baseStyles} {$variants[$variant]} {$sizes[$size]} cursor-pointer " . ($fullWidth ? 'w-full' : '');
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon) @svg($icon, ['class' => 'w-4 h-4']) @endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon) @svg($icon, ['class' => 'w-4 h-4']) @endif
        {{ $slot }}
    </button>
@endif
