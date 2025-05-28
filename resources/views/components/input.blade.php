@props(['type' => 'text', 'name', 'value' => '', 'placeholder' => ''])

@php
    $baseClass = 'input-field appearance-none relative block w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:z-10 sm:text-sm';
@endphp

<input type="{{ $type }}" name="{{ $name }}" value="{{old($name, $value)}}" placeholder="{{ $placeholder }}" 
    {{ $attributes->merge(['class' => $baseClass]) }}>
