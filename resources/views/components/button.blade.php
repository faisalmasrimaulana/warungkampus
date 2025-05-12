@props(['type' => 'button', 'color' => 'primary', 'href' => null])

@php
    $base = 'inline-flex items-center px-4 py-2 rounded-md text-sm font-semibold transition';

        $colors = [
        'primary' => 'bg-green-600 text-white hover:bg-white hover:text-green-600 hover:cursor-pointer',
        'secondary' => 'bg-white text-green-600 hover:bg-green-500 hover:text-white hover:cursor-pointer',  
        'success' => 'bg-green-600 text-white hover:bg-green-700',
        'danger' => 'bg-red-600 text-white hover:cursor-pointer hover:bg-white hover:text-red-700',
        'warning' => 'bg-yellow-500 text-white hover:bg-yellow-600',
        'nonactive' => 'bg-black text-white hover:bg-white hover:text-black hover:cursor-pointer'
    ];
@endphp


<button type="{{$type}}" {{ $attributes->merge(['class' => "$base {$colors[$color]}"]) }}>
    {{ $slot }}
</button>
