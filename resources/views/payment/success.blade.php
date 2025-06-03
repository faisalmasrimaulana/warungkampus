@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Pembayaran Berhasil!</h1>
    <p>Order ID: {{ $order->order_id }}</p>
    <p>Nama Pembeli: {{ $order->nama_pembeli }}</p>
    <p>Status: {{ ucfirst($order->status) }}</p>
    <a href="/" class="text-blue-600 underline">Kembali ke Beranda</a>
</div>
@endsection
