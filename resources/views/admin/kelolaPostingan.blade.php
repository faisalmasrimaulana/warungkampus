@extends('layouts.app')
@section('content')

    @if(session('success'))
      <x-successmodal></x-successmodal>
    @endif
  <!-- Main Content -->
  <div class="flex-1 flex flex-col overflow-hidden">

    <!-- Main Content Area -->
    <main class="flex-1 overflow-y-auto p-6 mt-20">
      <!-- Posts Table -->
      <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b">
          <h2 class="text-lg font-semibold text-gray-800">Daftar Postingan</h2>
        </div>

        <!-- FILTER DAN SEARCH -->
      <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
          <div class="flex flex-col w-full sm:flex-row">
            <form action="{{route('admin.product.filter')}}" method="GET" class="flex w-full justify-between">
              <div class="flex space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari posting..." class="search-input px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                  <i class="fas fa-magnifying-glass mr-2"></i>Cari
                </button>
              </div>

              <div class="flex space-x-2">
                <select name="kategori" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                  <option value="">Kategori</option>
                  <option value="barang" {{ request('kategori') == 'barang' ? 'selected' : '' }}>Barang</option>
                  <option value="jasa" {{ request('kategori') == 'jasa' ? 'selected' : '' }}>Jasa</option>
                </select>
                <select name="harga"  class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                  <option value="">Harga</option>
                  <option value="Terendah" {{ request('harga') == 'Terendah' ? 'selected' : '' }}>Terendah</option>
                  <option value="Tertinggi" {{ request('harga') == 'Tertinggi' ? 'selected' : '' }}>Tertinggi</option>
                </select>
                <select name="waktu"  class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                  <option value="">Waktu</option>
                  <option value="Terbaru" {{ request('waktu') == 'Terbaru' ? 'selected' : '' }}>Terbaru</option>
                  <option value="Terlama" {{ request('waktu') == 'Terlama' ? 'selected' : '' }}>Terlama</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                  <i class="fas fa-filter mr-2"></i>Filter
                </button>
              </div>
            </form>
          </div>
      </div>
        
        <div class="overflow-x-auto mt-10">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal dibuat</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @forelse($products as $prod)
              <tr class="table-row">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <img class="w-10 h-10 rounded mr-4" src="{{ asset('storage/' . $prod->thumbnail) }}" alt="Product">
                    <div>
                      <p class="text-sm text-black font-medium">{{$prod->nama_produk}}</p>
                      <p class="text-xs text-gray-500">{{$prod->mahasiswa->nama}}</p>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <span class="text-md capitalize">{{$prod->kategori}}</span>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$prod->harga_format}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$prod->created_at->format('d M Y')}}</td>
                <td class="px-6 py-4 wrap text-sm font-medium">{{$prod->deskripsi_singkat}}</td>
                <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                    <button class="action-btn text-blue-600 hover:text-blue-900 mr-3" title="Detail" data-nama="{{ $prod->nama_produk }}" data-deskripsi="{{ $prod->deskripsi_singkat }}"data-kategori="{{ $prod->kategori }}"data-harga="{{ $prod->harga_format }}"data-tanggal="{{ $prod->created_at->format('d M Y') }}" data-thumbnail="{{ asset('storage/' . $prod->thumbnail) }}" data-namauser="{{ $prod->mahasiswa->nama }}" data-emailuser="{{ $prod->mahasiswa->email }}" data-fotouser="{{ $prod->mahasiswa->foto_profil != 'fotoprofil.jpg' ? asset('storage/' . $prod->mahasiswa->foto_profil) : 'https://ui-avatars.com/api/?background=3b82f6&color=fff' }}" data-detailurl="{{ route('produk.detail', ['product'=>$prod->id]) }}">
                    <i class="fas fa-eye"></i>
                    </button>
                    <form id="deleteProdForm-{{ $prod->id }}" action="{{ route('admin.product.delete', $prod->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="action-btn text-red-600 hover:text-red-900 hover:cursor-pointer" type="button" onclick="deleteProd('{{ $prod->id }}')" title="Hapus">
                        <i class="fas fa-trash"></i></button>
                    </form>
                </td>
              </tr>
            @empty
              <tr class="table-row">
                <td class="text-center" colspan="6">
                  <h3 class="p-6 text-gray-500">Belum ada postingan</h3>
                </td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>
        <!-- PAGINATION -->
        <div class="mt-4 px-6">{{$products->links()}}</div>
      </div>
    </main>
    
  </div>

<!-- Post Detail Modal -->
<div id="postDetailModal" class="fixed inset-0 bg-black/50 items-center justify-center z-50 hidden">
  <div class="bg-white rounded-xl p-6 w-full max-w-2xl h-auto">
    <div class="flex justify-between items-center">
      <h2 class="text-2xl font-bold text-gray-800">Detail Postingan</h2>
      <button id="closePostDetailModal" class="text-gray-500 hover:text-gray-700">
        <i class="fas fa-times"></i>
      </button>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <img id="modal-thumbnail" src="" alt="Post Image" class="w-full h-auto rounded-lg">
      </div>
      <div>
        <h3 id="modal-nama" class="text-xl font-semibold mb-2"></h3>
        
        <div class="mb-4">
          <h4 class="text-md font-semibold">Deskripsi:</h4>
          <p id="modal-deskripsi" class="text-gray-600"></p>
        </div>
        
        <div class="grid grid-cols-2 gap-4 mb-4">
          <div>
            <h4 class="text-md font-semibold">Kategori:</h4>
            <p id="modal-kategori" class="text-gray-600 capitalize"></p>
          </div>
          <div>
            <h4 class="text-md font-semibold">Harga:</h4>
            <p id="modal-harga" class="text-gray-600"></p>
          </div>
          <div>
            <h4 class="text-md font-semibold">Tanggal:</h4>
            <p id="modal-tanggal" class="text-gray-600"></p>
          </div>
        </div>
        
        <div class="mb-4">
          <h4 class="text-md font-semibold">Pemilik:</h4>
          <div class="flex items-center mt-2">
            <img id="modal-fotouser" class="w-8 h-8 rounded-full mr-2" src="" alt="User">
            <div>
              <p id="modal-namauser" class="text-sm font-medium"></p>
              <p id="modal-emailuser" class="text-xs text-gray-500"></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="mt-6 flex justify-end space-x-3">
      <x-button id="closeModalBtn" color="danger">
        Tutup
      </x-button>
      <x-button id="modal-detail-btn" href="#" color="primary">
        Lihat
      </x-button>
    </div>
  </div>
</div>


    <!-- Delete Produk -->
  <x-modalconfirm identity="confirmationModalDeleteProd" title="Hapus Postingan" message="Apakah kamu yakin untuk menghapus postingan ini?">
    <x-button id="cancelDeleteProd" onclick="cancelDeleteProd()" color="primary" size="md">
      Batalkan
    </x-button>
    <x-button id="confirmDeleteProdButton" color="danger" size="md">
      Hapus Postingan
    </x-button>
  </x-modalconfirm>

  <script>

    let currentDeleteProdId = null;

    document.addEventListener('DOMContentLoaded', function() {
      // Post detail modal functionality
      const postDetailModal = document.getElementById('postDetailModal');
      const closePostDetailModal = document.getElementById('closePostDetailModal');
      const closeModalBtn = document.getElementById('closeModalBtn');
      const detailButtons = document.querySelectorAll('[title="Detail"]');
      
      detailButtons.forEach(button => {
      button.addEventListener('click', function () {
        const nama = button.dataset.nama;
        const deskripsi = button.dataset.deskripsi;
        const kategori = button.dataset.kategori;
        const harga = button.dataset.harga;
        const tanggal = button.dataset.tanggal;
        const thumbnail = button.dataset.thumbnail;
        const namauser = button.dataset.namauser;
        const emailuser = button.dataset.emailuser;
        const fotouser = button.dataset.fotouser;
        const detailurl = button.dataset.detailurl;

        // Masukkan ke dalam modal
        document.getElementById('modal-thumbnail').src = thumbnail;
        document.getElementById('modal-nama').textContent = nama;
        document.getElementById('modal-deskripsi').textContent = deskripsi;
        document.getElementById('modal-kategori').textContent = kategori;
        document.getElementById('modal-harga').textContent = harga;
        document.getElementById('modal-tanggal').textContent = tanggal;
        document.getElementById('modal-namauser').textContent = namauser;
        document.getElementById('modal-emailuser').textContent = emailuser;
        document.getElementById('modal-fotouser').src = fotouser;
        document.getElementById('modal-detail-btn').href = detailurl;

        postDetailModal.classList.remove('hidden');
        postDetailModal.classList.add('flex');
      });
      });
      
      closePostDetailModal.addEventListener('click', function() {
        postDetailModal.classList.add('hidden');
        postDetailModal.classList.remove('flex');
      });
      
      closeModalBtn.addEventListener('click', function() {
        postDetailModal.classList.add('hidden');
      });
      }
    );

      // Hapus Produk
    function deleteProd(id) {
        currentDeleteProdId = id;
        document.getElementById('confirmationModalDeleteProd').classList.remove('hidden');
        document.getElementById('confirmationModalDeleteProd').classList.add('flex');
    }

    // Konfirmasi Hapus Produk
    document.getElementById('confirmDeleteProdButton').onclick = function(e) {
        e.preventDefault();
        if (currentDeleteProdId) {
            document.getElementById('deleteProdForm-' + currentDeleteProdId).submit();
        }
    }

    // Batalkan Hapus Produk
    function cancelDeleteProd() {
        document.getElementById("confirmationModalDeleteProd").classList.remove('flex');
        document.getElementById("confirmationModalDeleteProd").classList.add('hidden');
        currentDeleteProdId = null;
    }
  </script>

@endsection