@extends('layouts.app')

@section('content')
<div class="container mt-20 mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Pembayaran Berhasil!</h1>
    <p>Order ID: {{ $order->order_id }}</p>
    <x-button onclick="copyText(`http://127.0.0.1:8000/weeklysub/success?order_id={{$order->order_id}}`)" color="success" class="mb-5" size="md">Salin Bukti Pembayaran</x-button>
    <p>Nama Pembeli: {{ $order->user->nama }}</p>
    <p>Produk: {{$order->product1->nama_produk}}</p>
    <p>Produk: {{$order->product2->nama_produk}}</p>
    <p>Status: {{ ucfirst($order->payment_status) }}</p>
    <x-button href="{{route('home')}}" color="secondary" class="mt-5" size="md">Kembali ke Beranda</x-button>
</div>

<script>
  function copyText(text) {
    navigator.clipboard.writeText(text).then(() => {
      alert("Link berhasil disalin!");
    });
  }
</script>

@endsection