@props(['type' => 'button', 'color' => 'primary', 'href' => null, 'size'=>'lg'])

@php
    $base = 'inline-flex items-center px-4 py-2 rounded-md text-sm font-semibold transition';

        $colors = [
        'primary' => 'bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-full shadow-lg hover:shadow-xl transition hover:from-blue-600 hover:to-blue-700 hover:cursor-pointer',
        'secondary' => 'bg-white text-blue-600 shadow-lg hover:shadow-xl hover:cursor-pointer hover:bg-gray-100',  
        'success' => 'bg-gradient-to-r from-green-500 to-green-600 text-white rounded-full shadow-lg hover:shadow-xl transition hover:from-green-600 hover:to-green-700 hover:cursor-pointer',
        'danger' => 'hover:shadow-xl bg-red-600 text-white text-center hover:cursor-pointer hover:bg-red-800 hover:text-white',
        'warning' => 'bg-yellow-500 hover:shadow-xl text-white hover:bg-yellow-600 hover:cursor-pointer',
        'nonactive' => 'hover:shadow-xl bg-gray-700 text-white hover:bg-gray-800 hover:text-white',
        'disable' => 'hover:shadow-xl bg-gray-200 text-black hover:cursor-not-allowed'
    ];

    $sizes = [
        'sm' => 'px-3 py-1 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-6 py-3 text-base',
        'xl' => 'px-8 py-4 text-base',
    ];

    $class = "{$base} {$sizes[$size]} {$colors[$color]}"
@endphp


@if($href)
    <a href="{{$href}}" {{ $attributes->merge(['class' => $class]) }}>
        {{$slot}}
    </a>
@else
    <button type="{{$type}}" {{ $attributes->merge(['class' => $class]) }}>
        {{ $slot }}
    </button>
@endif
