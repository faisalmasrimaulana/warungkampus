@props(['status'])

@php
    $color = [
        'pending' => 'text-xs px-2 py-1 rounded-full bg-yellow-100 text-yellow-800',
        'verified' => 'text-xs px-2 py-1 rounded-full bg-green-100 text-green-800',
        'rejected' => 'text-xs px-2 py-1 rounded-full bg-red-100 text-red-800',
    ];
    $label = [
        'pending' => 'Menunggu',
        'verified' => 'Terverifikasi',
        'rejected' => 'Ditolak',
    ];
    $class = $color[$status] ?? 'bg-gray-200 text-gray-800';
@endphp

<span {{ $attributes->merge([ 'class' => $class])}}> {{$label[$status] ?? $status}} </span>