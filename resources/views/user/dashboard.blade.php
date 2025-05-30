<!-- DASHBOARD USER-->

@extends('layouts.app')

@section('content')
<style>
    .dashboard-gradient {
      background: linear-gradient(135deg, #f0f4ff 0%, #e6f0ff 100%);
    }
    .product-card {
      transition: all 0.3s ease;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }
    .product-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    .status-badge {
      font-size: 0.75rem;
      padding: 0.25rem 0.75rem;
      border-radius: 1rem;
    }
</style>

<!-- Main Content -->
<div class="min-h-screen pt-24 pb-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-6xl mx-auto">
<!-- Header Profil -->
    <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8 bg-white rounded-2xl p-6 shadow-sm">
      <div class="flex-1 mb-4 md:mb-0">
        <div class="flex items-start">
          <img src="{{ Auth::user()->foto_profil!= 'fotoprofil.jpg' ? asset('storage/' . Auth::user()->foto_profil) : asset('assets/fotoprofil.jpg')}}" alt="Profil" class="w-16 h-16 rounded-full border-4 border-blue-100 mr-4">
          <div class="flex-1">
            <div class="flex items-center mb-2">
              <h1 class="text-2xl font-bold text-gray-800 mr-3">{{Auth::user()->nama}}</h1>
              <span class="status-badge bg-blue-100 text-blue-800">Mahasiswa Aktif</span>
            </div>
            <p class="text-gray-600 mb-2">{{Auth::user()->bio == null ? 'Halo, I am here!' : Auth::user()->bio}}</p>

            <i data-feather="map-pin" class="inline-block align-middle"></i><span class="text-gray-600 mb-2 ml-2 align-middle inline-block">{{ Auth::user()->alamat ?? 'Alamat belum diisi' }}</span>

            <div class="flex items-center space-x-3">
              <a href="https://www.instagram.com/{{Auth::user()->instagram}}" class="text-blue-600 hover:text-blue-800 flex items-center gap-2"><i data-feather="instagram"></i>{{Auth::user()->instagram}}</a>
              <a href="https://wa.me/{{Auth::user()->whatsapp}}" class="text-green-600 hover:text-green-800 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>{{Auth::user()->whatsapp}}
              </a>
            </div>
          </div>
        </div>
      </div>
      <x-button href="{{route('user.edit', Auth::user()->id)}}" 
              class="flex items-center self-start">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
          <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
        </svg>
        Edit Profil
      </x-button>
    </div>

    <!-- Kelola Produk -->
    <div class="bg-white rounded-2xl p-6 shadow-sm">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Kelola Postingan Produk Anda</h2>
        <x-button href="{{route('user.post')}}"
                class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
          </svg>
          Tambah Produk Baru
        </x-button>
      </div>

      <!-- List Produk -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @if($products->isEmpty())
        <p>Tidak ada Produk</p>
        @else
        <!-- Product 1 -->
         @foreach($products as $prod)
           <div class="product-card bg-white rounded-xl p-4">
            <a href="{{ route('produk.detail', ['id' => $prod->id]) }}">
             <div class="relative mb-4">
               <img src="{{asset('storage/' . ($prod->fotoproduk->first()->path_fotoproduk))}}" alt="Produk" class="w-full h-48 object-cover rounded-lg">
               
               <span class="status-badge absolute top-2 left-2
                  {{ $prod->is_sold ? 'bg-gray-300 text-gray-600' : 'bg-blue-100 text-blue-800' }}">
                  {{ $prod->is_sold ? 'Terjual' : 'Tersedia' }}
                </span>
             </div>

             <div class="mb-4">
               <h3 class="font-semibold text-lg mb-1">{{$prod->nama_produk}}</h3>
               <p class="text-gray-600 text-sm mb-2">Rp {{ number_format($prod->harga, 0, ',', '.') }}</p>
               <p class="text-xs text-gray-500">{{$prod->created_at->diffForHumans()}}</p>
             </div>
              </a>
             <div class="flex justify-between items-center gap-3">
              <form action="{{route('user.product.edit', ['id' => $prod->id])}}" method="GET">
               <x-button onclick="editProduct('1.edit')" type="submit" class="px-3 py-1" >
                 Edit
               </x-button>
              </form>
               <!-- button hapus -->
              <form id="deleteForm-{{ $prod->id }}" action="{{ route('user.product.delete', ['id' => $prod->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                
                <x-button onclick="deleteProduct('{{ $prod->id }}')" type="button" color="danger">
                  Hapus
                </x-button>

              </form>

               <form action="{{ route('user.product.markAsSold', ['id' => $prod->id]) }}" method="POST" onsubmit="return confirm('Yakin mau tandai produk ini sebagai terjual?')">
                  @csrf
                  <x-button type="submit" color="success">
                    Tandai Terjual
                  </x-button>
                </form>
             </div>
           </div>
         @endforeach
         @endif
      </div>
    </div>
  </div>
</div>

<!-- Konfirmasi Terjual -->
<div id="confirmationModal" class="fixed inset-0 bg-transparent bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-white rounded-xl p-6 max-w-sm w-full mx-4">
    <h3 class="text-lg font-semibold mb-4" id="modalTitle"></h3>
    <p class="text-gray-600 mb-6" id="modalMessage"></p>
    <div class="flex justify-end space-x-3">
      <!-- Button batal -->
      <button onclick="closeModal()" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
        Batal
      </button>
      <button id="confirmAction" class="px-4 py-2 text-white rounded-lg">
        Konfirmasi
      </button>
    </div>
  </div>
</div>

<script>

  function markAsSold(productId) {
    showModal(
      'Tandai Terjual',
      'Apakah Anda yakin ingin menandai produk ini sebagai terjual?',
      'bg-green-500 hover:bg-green-600',
      () => {
        console.log(`Produk ${productId} ditandai terjual`);
        closeModal();
      }
    );
  }

  // Fungsi untuk konfirmasi delete
    let currentDeleteId = null;

  function deleteProduct(id) {
    currentDeleteId = id;
    document.getElementById('modalTitle').textContent = 'Hapus Produk';
    document.getElementById('modalMessage').textContent = 'Apakah Anda yakin ingin menghapus produk ini?';
    const confirmBtn = document.getElementById('confirmAction');
    confirmBtn.className = 'px-4 py-2 text-white rounded-lg bg-red-500 hover:bg-red-600';
    confirmBtn.onclick = confirmDelete;
    document.getElementById('confirmationModal').classList.remove('hidden');
    document.getElementById('confirmationModal').classList.add('flex');
  }

  function confirmDelete() {
    if (currentDeleteId) {
      document.getElementById('deleteForm-' + currentDeleteId).submit();
    }
    closeModal();
  }

  function closeModal() {
    document.getElementById('confirmationModal').classList.remove('flex');
    document.getElementById('confirmationModal').classList.add('hidden');
  }

</script>


@endsection