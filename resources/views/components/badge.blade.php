@props(['status'])

@php
    $color = [
        'pending' => 'text-xs px-2 py-1 rounded-full bg-yellow-100 text-yellow-800',
        'verified' => 'text-xs px-2 py-1 rounded-full bg-green-100 text-green-800',
        'blocked' => 'text-xs px-2 py-1 rounded-full bg-red-100 text-red-800',
        'expired' => 'text-xs px-2 py-1 rounded-full bg-red-100 text-red-800',
        'active' => 'text-xs px-2 py-1 rounded-full bg-green-100 text-green-800',
        'available' => 'text-xs px-2 py-1 rounded-full bg-green-300 text-green-800',
        'sold' => 'text-xs px-2 py-1 rounded-full bg-gray-300 text-gray-600',
        'complete' => 'text-xs px-2 py-1 rounded-full bg-green-100 text-green-800',
    ];
    $label = [
        'pending' => 'Menunggu',
        'verified' => 'Terverifikasi',
        'blocked' => 'Diblokir',
        'expired' => 'Kadaluarsa',
        'active' => 'Aktif',
        'available' => 'Tersedia',
        'sold' => 'Stok Habis',
        'complete' => 'Selesai',
    ];
    $class = $color[$status] ?? 'bg-gray-200 text-gray-800';
@endphp

<span {{ $attributes->merge([ 'class' => $class])}}> {{$label[$status] ?? $status}} </span>