@props([
    'label' => null,
    'name' => null,
    'type' => 'text',
    'placeholder' => null,
    'required' => false,
    'error' => null,
    'icon' => null
])

@php
    $name = $name ?? $attributes->get('wire:model');
    $id = $name ?? 'input-' . Str::random(8);
@endphp

<div class="w-full">
    @if($label)
        <label for="{{ $id }}" class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">
            {{ $label }}
        </label>
    @endif

    <div class="relative group">
        @if($icon)
            <div class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-primary transition-colors">
                @svg($icon, ['class' => 'w-4 h-4'])
            </div>
        @endif

        <input 
            type="{{ $type }}" 
            id="{{ $id }}" 
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge(['class' => 'w-full bg-brand-neutral border rounded-2xl py-4 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-bold text-gray-900 ' . ($icon ? 'pl-12 pr-5' : 'px-5') . ($errors->has($name) || $error ? ' border-primary' : ' border-gray-100')]) }}
        >
    </div>

    @if($name)
        @error($name)
            <p class="mt-2 text-[10px] font-bold text-primary uppercase tracking-wide px-1">{{ $message }}</p>
        @enderror
    @endif
    
    @if($error && (!$name || !$errors->has($name)))
        <p class="mt-2 text-[10px] font-bold text-primary uppercase tracking-wide px-1">{{ $error }}</p>
    @endif
</div>
