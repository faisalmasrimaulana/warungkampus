@props(['type' => 'text', 'name', 'label'=>null, 'value' => '', 'placeholder' => '', 'autofocus'=> false])

@php
    $baseClass = 'input-field appearance-none relative block w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:z-10 sm:text-sm';
@endphp

    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    @endif
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $autofocus ? 'autofocus' : '' }}
        {{ $attributes->merge(['class' => $baseClass]) }}
    >
    @error($name)
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
    @enderror
