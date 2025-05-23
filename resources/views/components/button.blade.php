<!-- untuk merubah type button bisa pakai type="tipe_button" untuk merubah gaya warna button bisa memakai color="warna sesuai colors di bawah ini", bisa ditambahkan dengan yang lain-->

@props(['type' => 'button', 'color' => 'primary', 'href' => null])

@php
    $base = 'inline-flex items-center px-4 py-2 rounded-md text-sm font-semibold transition';

        $colors = [
        'primary' => 'bg-gradient-to-r from-blue-500 to-blue-600 text-white px-8 py-3 rounded-full shadow-lg hover:shadow-xl transition hover:from-blue-600 hover:to-blue-700 hover:cursor-pointer',
        'secondary' => 'bg-white text-blue-600 shadow-lg hover:shadow-xl hover:cursor-pointer hover:bg-gray-100 px-8 py-3',  
        'success' => 'bg-gradient-to-r from-green-500 to-green-600 text-white px-8 py-3 rounded-full shadow-lg hover:shadow-xl transition hover:from-green-600 hover:to-green-700 hover:cursor-pointer',
        'danger' => 'bg-red-600 text-white text-center hover:cursor-pointer hover:bg-white hover:text-red-700 px-8 py-3',
        'warning' => 'bg-yellow-500 text-white hover:bg-yellow-600',
        'nonactive' => 'bg-black text-white hover:bg-white hover:text-black hover:cursor-pointer'
    ];
@endphp

<button type="{{$type}}" {{ $attributes->merge(['class' => "$base {$colors[$color]}"]) }}>
    {{ $slot }}
</button>
