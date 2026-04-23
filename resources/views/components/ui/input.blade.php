@props([
    'label' => null,
    'name',
    'type' => 'text',
    'placeholder' => null,
    'required' => false,
    'error' => null
])

<div class="w-full">
    @if($label)
        <label for="{{ $name }}" class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 px-1">
            {{ $label }}
        </label>
    @endif

    <input 
        type="{{ $type }}" 
        id="{{ $name }}" 
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'w-full bg-brand-neutral/50 border rounded-2xl px-5 py-4 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all font-medium text-gray-700 ' . ($errors->has($name) || $error ? 'border-primary' : 'border-gray-100')]) }}
    >

    @error($name)
        <p class="mt-2 text-[10px] font-bold text-primary uppercase tracking-wide px-1">{{ $message }}</p>
    @enderror
    
    @if($error && !$errors->has($name))
        <p class="mt-2 text-[10px] font-bold text-primary uppercase tracking-wide px-1">{{ $error }}</p>
    @endif
</div>
