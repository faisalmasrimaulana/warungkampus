<!-- DASHBOARD USER-->
@extends('layouts.app')
@section('content')

<!-- Main Content -->
<div class="min-h-screen pt-24 pb-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-6xl mx-auto">
<!-- Header Profil -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8 bg-white rounded-2xl p-6 shadow-sm">
      <div class="flex-1 mb-4 md:mb-0">
        <div class="flex items-start">
          <img src="{{ $user->foto_profil!= 'fotoprofil.jpg' ? asset('storage/' . $user->foto_profil) : 'https://ui-avatars.com/api/?background=3b82f6&color=fff'}}" alt="Profil" class="w-16 h-16 rounded-full border-4 border-blue-100 mr-4">
          <div class="flex-1">
            <div class="flex items-center mb-2">
              <h1 class="text-2xl font-bold text-gray-800 mr-3">{{$user->nama}}</h1>
              <x-badge status="active"></x-badge>
            </div>

            <!-- BIO -->
            <p class="text-gray-600 mb-2">{{$user->bio == null ? 'Hallo, I am here!' : $user->bio}}</p>

            <!-- ALAMAT DAN MEDSOS -->
            <div class="flex space-x-3">
              <p class="text-gray-800 hover:text-black flex items-center gap-2"><i class="fa-solid fa-location-dot fa-lg hover:cursor-default"></i>{{ $user->alamat ?? 'Alamat belum diisi' }}</p>

              <a href="https://www.instagram.com/{{$user->instagram}}" class="text-blue-600 hover:text-blue-800 flex items-center gap-2"><i class="fa-brands fa-instagram fa-lg"></i>{{$user->instagram}}</a>

              <a href="https://wa.me/{{$user->whatsapp}}" class="text-green-600 hover:text-green-800 flex items-center gap-2"><i class="fa-brands fa-whatsapp fa-lg"></i>{{$user->nama}}
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>

      <!-- List Produk -->
    <div class="bg-white rounded-2xl p-6 shadow-sm">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Produk {{$user->nama}}</h2>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @if($products->isEmpty())
        <p>Tidak ada Produk</p>
        @else
        <!-- Product 1 -->
          @foreach($products as $prod)
            <div class="product-card bg-white rounded-xl p-4 transition hover:-translate-y-1 hover:shadow-lg shadow-sm">
              <a href="{{ route('produk.detail', ['id' => $prod->id]) }}">
              <div class="relative mb-4">
                <img src="{{asset('storage/' . ($prod->fotoproduk->first()->path_fotoproduk))}}" alt="Produk" class="w-full h-48 object-cover rounded-lg">
                
                <x-badge :status="$prod->is_sold ? 'sold' : 'available'" class="absolute top-2 left-2" />
              </div>

              <div class="mb-4">
                <h3 class="font-semibold text-lg mb-1">{{$prod->nama_produk}}</h3>
                <p class="text-gray-600 text-sm mb-2">Rp {{ number_format($prod->harga, 0, ',', '.') }}</p>
                <p class="text-xs text-gray-500">{{$prod->created_at->diffForHumans()}}</p>
              </div>
                </a>
            </div>
          @endforeach
         @endif
      </div>
    </div>
  </div>
</div>
@endsection