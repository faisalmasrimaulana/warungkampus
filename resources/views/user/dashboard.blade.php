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
          <img src="{{ Auth::user()->foto_profil!= 'fotoprofil.jpg' ? asset('storage/' . Auth::user()->foto_profil) : 'https://ui-avatars.com/api/?background=3b82f6&color=fff'}}" alt="Profil" class="w-16 h-16 rounded-full border-4 border-blue-100 mr-4">
          <div class="flex-1">
            <div class="flex items-center mb-2">
              <h1 class="text-2xl font-bold text-gray-800 mr-3">{{Auth::user()->nama}}</h1>
              <x-badge status="active"></x-badge>
            </div>

            <!-- BIO -->
            <p class="text-gray-600 mb-2">{{Auth::user()->bio == null ? 'Hallo, I am here!' : Auth::user()->bio}}</p>

            <!-- ALAMAT DAN MEDSOS -->
            <div class="flex space-x-3">
              <p class="text-gray-800 hover:text-black flex items-center gap-2"><i class="fa-solid fa-location-dot fa-lg hover:cursor-default"></i>{{ Auth::user()->alamat ?? 'Alamat belum diisi' }}</p>

              <a href="https://www.instagram.com/{{Auth::user()->instagram}}" class="text-blue-600 hover:text-blue-800 flex items-center gap-2"><i class="fa-brands fa-instagram fa-lg"></i>{{Auth::user()->instagram}}</a>

              <a href="https://wa.me/{{Auth::user()->whatsapp}}" class="text-green-600 hover:text-green-800 flex items-center gap-2"><i class="fa-brands fa-whatsapp fa-lg"></i>{{Auth::user()->whatsapp}}
              </a>
            </div>

          </div>
        </div>
      </div>
      <x-button href="{{route('user.edit', Auth::user()->id)}}">
        <p class="gap-2 flex items-center">
          <i class="fa-solid fa-user-pen"></i>Edit Profil
        </p>
      </x-button>
    </div>

    <!-- Kelola Produk -->
    <div class="bg-white rounded-2xl p-6 shadow-sm">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Kelola Postingan Produk Anda</h2>
        <x-button href="{{route('user.post')}}"
                class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition flex items-center">
        <p class="flex items-center gap-2">
          <i class="fa-solid fa-plus"></i>Tambah Produk Baru
        </p>
        </x-button>
      </div>

      <!-- List Produk -->
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
              <div class="flex justify-between items-center gap-3">
                <form action="{{route('user.product.edit', ['id' => $prod->id])}}" method="GET">
                <x-button size="sm" type="submit" class="px-3 py-1" >
                  Edit
                </x-button>
                </form>
                <!-- button hapus -->
                <form id="deleteForm-{{ $prod->id }}" action="{{ route('user.product.delete', ['id' => $prod->id]) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <x-button size="sm" onclick="deleteProduct('{{ $prod->id }}')" type="button" color="danger">
                    Hapus
                  </x-button>
                </form>

                <form id="markForm-{{ $prod->id }}" action="{{ route('user.product.markAsSold', ['id' => $prod->id]) }}" method="POST">
                  @csrf
                    @if(!$prod->is_sold)
                    <x-button size="sm" type="button" color="success" onclick="markProduct('{{ $prod->id }}')">Tandai Terjual</x-button>
                    @else
                    <x-button size="sm" type="button" color="nonactive" disabled>
                    Terjual
                    </x-button>
                    @endif
                </form>
              </div>
            </div>
          @endforeach
         @endif
      </div>

    </div>

    <div class="bg-white mt-5 rounded-2xl p-6 shadow-sm">
      <h2 class="text-xl font-semibold text-gray-800">Kelola History Pembayaran Produk Anda</h2>
        <div class=" payment">
          @if($paymentHistories->isEmpty())
            <p class="text-gray-500">Belum ada history pembayaran.</p>
          @else
            <div class="overflow-x-auto">
              <table class="min-w-full bg-white text-sm text-left border rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                  <tr>
                    <th class="px-6 py-3">Produk</th>
                    <th class="px-6 py-3">Pembeli</th>
                    <th class="px-6 py-3">Harga</th>
                    <th class="px-6 py-3">Waktu Transaksi</th>
                    <th class="px-6 py-3">Status</th>
                  </tr>
                </thead>
                <tbody class="text-gray-700">
                  @foreach($paymentHistories as $history)
                    <tr class="border-t">
                      <td class="px-6 py-4">{{ $history->product->nama_produk ?? '-' }}</td>
                      <td class="px-6 py-4">{{ $history->email_pembeli }}</td>
                      <td class="px-6 py-4">Rp {{ number_format($history->harga, 0, ',', '.') }}</td>
                      <td class="px-6 py-4">{{ \Carbon\Carbon::parse($history->created_at)->format('d M Y H:i') }}</td>
                      <td class="px-6 py-4">
                        @php
                          $status = $history->status;
                        @endphp

                        @if($status === 'success')
                          <span class="text-green-600 font-medium">Sukses</span>
                        @elseif($status === 'pending')
                          <span class="text-yellow-500 font-medium">Menunggu</span>
                        @elseif(in_array($status, ['expire', 'cancel', 'deny', 'failure']))
                          <span class="text-red-500 font-medium">Gagal</span>
                        @else
                          <span class="text-gray-500 font-medium">Tidak Diketahui</span>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
        </div>
    </div>
  </div>
</div>


<!-- Konfirmasi Terjual -->
<x-modalconfirm identity="confirmationModalDelete" title="Hapus Post" message="Apakah kamu yakin untuk menghapus postingan ini?">
      <x-button id="cancelDelete" onclick="cancelDelete()" color="primary" size="md">
        Batalkan
      </x-button>
      <x-button id="confirmDeleteButton" color="danger" size="md">
        Hapus Post
      </x-button>
</x-modalconfirm>


<x-modalconfirm identity="confirmationModalSold"  title="Tandai sebagai terjual" message="Apakah kamu ingin menandai produk ini sebagai terjual?">
        <x-button id="cancelMark" onclick="cancelMark()" color="primary" size="md">
        Batalkan
      </x-button>
      <x-button id="confirmMarkButton" color="success" size="md">
        Tandai Terjual
      </x-button>
</x-modalconfirm>



<script>

    // Simpan id produk yang akan dihapus/ditandai
    let currentDeleteId = null;
    let currentMarkId = null;

  // Hapus produk
  function deleteProduct(id) {
      currentDeleteId = id;
      document.getElementById('confirmationModalDelete').classList.remove('hidden');
      document.getElementById('confirmationModalDelete').classList.add('flex');
  }

// Konfirmasi hapus
  document.getElementById('confirmDeleteButton').onclick = function(e) {
      e.preventDefault();
      if (currentDeleteId) {
          document.getElementById('deleteForm-' + currentDeleteId).submit();
      }
  }

  // Batalkan hapus
  function cancelDelete() {
      document.getElementById("confirmationModalDelete").classList.remove('flex');
      document.getElementById("confirmationModalDelete").classList.add('hidden');
      currentDeleteId = null;
  }

  // Tandai terjual
  function markProduct(id) {
      currentMarkId = id;
      document.getElementById('confirmationModalSold').classList.remove('hidden');
      document.getElementById('confirmationModalSold').classList.add('flex');
  }

  // Konfirmasi tandai terjual
  document.getElementById('confirmMarkButton').onclick = function(e) {
      e.preventDefault();
      if (currentMarkId) {
          document.getElementById('markForm-' + currentMarkId).submit();
      }
  }

  // Batalkan tandai terjual
  function cancelMark() {
      document.getElementById("confirmationModalSold").classList.remove('flex');
      document.getElementById("confirmationModalSold").classList.add('hidden');
      currentMarkId = null;
  }
</script>


@endsection