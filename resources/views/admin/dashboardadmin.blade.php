@extends('layouts.app')

@section('content')
    <!-- MODAL KTM USER -->
    @if(session('success'))
      <x-successmodal></x-successmodal>
    @endif
    <x-modalktm/>

    <!-- MAIN CONTENT -->
    <div class="flex-1 overflow-y-auto p-6 mt-20">

      <!-- STATISTIK DASHBOARD -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- TOTAL PENGGUNA TERVERIFIKASI-->
        <div class="bg-gradient-to-br from-white to-slate-100 shadow transition-all duration-300 hover:-translate-y-1 hover:shadow-lg rounded-xl p-6">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-500">Total Penjual</p>
              <h3 class="text-2xl font-bold text-gray-800">{{$totalUsers}}</h3>
            </div>
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
              <i class="fas fa-users text-xl"></i>
            </div>
          </div>
        </div>
        
        <!-- POSTINGAN AKTIF PRODUK YANG TERSEDIA -->
        <div class="rounded-xl p-6 bg-gradient-to-br from-white to-slate-100 shadow transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-500">Postingan Aktif</p>
              <h3 class="text-2xl font-bold text-gray-800">{{$totalActiveProduct}}</h3>
            </div>
            <div class="p-3 rounded-full bg-green-100 text-green-600">
              <i class="fas fa-box-open text-xl"></i>
            </div>
          </div>
        </div>
        
        <!-- TOTAL USER YANG BELUM TERVERIFIKASI -->
        <div class="rounded-xl p-6 bg-gradient-to-br from-white to-slate-100 shadow transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-500">Menunggu Verifikasi</p>
              <h3 class="text-2xl font-bold text-gray-800">{{$totalUnverified}}</h3>
            </div>
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
              <i class="fas fa-clock text-xl"></i>
            </div>
          </div>
        </div>
      </div>
      <!-- ./STATISTIK DASHBOARD -->

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- LIST USER -->
        <div class="bg-white rounded-xl shadow-sm p-6">
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Verifikasi User</h2>
            <a href="{{route('admin.user.kelola')}}" class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">KTM</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
              </thead>
            @forelse($users as $user )
              <tbody class="bg-white divide-y divide-gray-200">
                <tr class="hover:bg-gray-100">
                  <td class="px-4 py-3 whitespace-nowrap">
                    <div class="flex items-center">
                      <img class="w-8 h-8 rounded-full mr-3" src="{{ $user->foto_profil != 'fotoprofil.jpg' ? asset('storage/' . $user->foto_profil) : 'https://ui-avatars.com/api/?background=3b82f6&color=fff'}}" alt="User">
                      <div>
                        <p class="text-sm font-medium">{{$user->nama}}</p>
                        <p class="text-xs text-gray-500">{{$user->email}}</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-4 py-3 whitespace-nowrap">
                    @if($user->is_verified==0)
                    <x-badge status="pending"></x-badge>
                    @elseif($user->is_blocked==1)
                    <x-badge status="blocked"></x-badge>
                    @else
                    <x-badge status="verified"></x-badge>
                    @endif
                  </td>
                  <td class="px-4 py-3 whitespace-nowrap">
                    <x-button class="view-ktm-btn" size="sm" data-ktm="{{asset('storage/' . $user->ktm)}}" data-name="{{$user->nama}}" data-email="{{$user->email}}" data-date="{{$user->created_at->diffForHumans()}}">
                      Lihat KTM
                    </x-button>
                  </td>
                
                  <!-- VERIFIKASI USER -->
                  @if(!$user->is_verified)
                  <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <form action="{{ route('admin.user.verifikasi', $user->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                        <button class="action-btn text-green-600 hover:text-green-900 mr-2 hover:cursor-pointer" type="submit" title="Setujui">
                        <i class="fas fa-check"></i>
                        </button>
                    </form>
                    <form id="deleteForm-{{ $user->id }}" action="{{ route('admin.user.hapus', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="deleteUser('{{ $user->id }}')" class="action-btn text-red-600 hover:text-red-900 hover:cursor-pointer" title="Hapus User" type="button">
                          <i class="fas fa-trash" ></i>
                        </button>
                    </form>
                  </td>
                  <!-- VERIFIKASI USER -->
                  @else
                  <!-- KELOLA USER -->
                  <td class="px-2 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <!-- Lihat User -->
                    <button class="action-btn text-blue-600 hover:text-blue-900 mr-3" title="Detail">
                      <a href="{{route('user.publicprofile', ['user'=>$user->id])}}">
                        <i class="fas fa-eye"></i>
                      </a>
                    </button>
                    @if(!$user->is_blocked)
                    <!-- BLock/Unblock User -->
                      <form id="blockForm-{{ $user->id }}" action="{{ route('admin.user.blokir', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PUT')
                        <button onclick="blockUser('{{ $user->id }}')" type="button" class="action-btn hover:cursor-pointer text-yellow-600 hover:text-red-900 mr-3" title="Blokir">
                        <i class="fas fa-ban"></i>
                        </button>
                      </form>
                    @else
                        <form id="unblockForm-{{ $user->id }}" action="{{ route('admin.user.bukablokir', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="hover:cursor-pointer action-btn text-green-600 hover:text-green-900" title="Aktifkan Kembali">
                            <i class="fas fa-redo mr-3"></i>
                        </button>
                      </form>
                    @endif
                    <!-- Delete User -->
                    <form id="deleteForm-{{ $user->id }}" action="{{ route('admin.user.hapus', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="deleteUser('{{ $user->id }}')" class="action-btn text-red-600 hover:text-red-900 hover:cursor-pointer" title="Hapus User" type="button">
                          <i class="fas fa-trash" ></i>
                        </button>
                    </form>
                  </td>
                  @endif
                  <!-- ./KELOLA USER -->
                </tr>
                @empty
                  <tr>
                    <td colspan="4" class="text-center text-gray-500 p-6">
                      Tidak ada User didatabase
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <!-- ./LIST USER -->

        <!-- LIST LANGGANAN -->
        <div class="bg-white rounded-xl shadow-sm p-6">
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Langganan User</h2>
            <a href="{{route('admin.subscribe.kelola')}}" class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paket</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @forelse($subscriptions as $sub )
                  <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3 whitespace-nowrap">
                      <div class="flex items-center">
                        <img class="w-8 h-8 rounded-full mr-3" src="{{ $sub->user->foto_profil != 'fotoprofil.jpg' ? asset('storage/' . $sub->user->foto_profil) : 'https://ui-avatars.com/api/?background=3b82f6&color=fff'}}" alt="User">
                        <div>
                          <p class="text-sm font-medium">{{$sub->user->nama}}</p>
                          <p class="text-xs text-gray-500">{{$sub->user->email}}</p>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm whitespace-nowrap">
                      {{$sub->type}}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">
                       @if($sub->expired_at > now())
                          <x-badge status="active"></x-badge>
                        @else
                          <x-badge status="expired"></x-badge>
                        @endif
                    </td>
                    <td>
                      @foreach($sub->products as $prod)
                        <p class="text-sm">{{$prod}}</p>
                      @endforeach
                    </td>
                  </tr>
                @empty
                  <tr>
                  <td colspan="4" class="text-center text-gray-500 p-6">
                    Tidak ada User yang berlangganan
                  </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <!-- ./LIST LANGGANAN -->

        <!-- LIST POSTINGAN -->
        <div class="bg-white rounded-xl shadow-sm p-6">
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Postingan</h2>
            <a href="{{route('admin.product.kelola')}}" class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @forelse($products as $prod )
                <tr class="hover:bg-gray-100">
                  <td class="px-4 py-3 whitespace-nowrap">
                    <div class="flex items-center">
                      <img class="w-8 h-8 rounded-md mr-3" src="{{ asset('storage/' . $prod->thumbnail) }}" alt="User">
                      <div>
                        <p class="text-sm font-medium">{{$prod->nama_produk}}</p>
                        <p class="text-xs text-gray-500">{{$prod->mahasiswa->nama}}</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-4 py-3 whitespace-nowrap">
                    <p class="text-sm font-medium capitalize">{{$prod->kategori}}</p>
                  </td>
                  <td class="px-4 py-3 whitespace-nowrap">
                    <p class="text-sm font-medium">{{$prod->harga_format}}</p>
                  </td>
                  <td class="px-4 py-4 whitespace-nowrap text-left text-sm font-medium">
                    <button class="action-btn text-blue-600 hover:text-blue-900 mr-3" title="Detail">
                      <a href="{{route('produk.detail', ['product'=>$prod->id])}}">
                        <i class="fas fa-eye"></i>
                      </a>
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
                <tr>
                  <td colspan="4" class="text-center text-gray-500 p-6">
                    Belum ada postingan
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <!-- ./LIST POSTINGAN -->

        <!-- LIST LAPORAN -->
        <div class="bg-white rounded-xl shadow-sm p-6">
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Laporan</h2>
            <a href="{{route('admin.user.kelola')}}" class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detail laporan</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                @forelse($laporans as $lapor)
                <tr class="hover:bg-gray-100">
                  <td class="px-4 py-3 whitespace-nowrap">
                      <p class="text-sm font-medium">{{$lapor->nama}}</p>
                  </td>
                  <td class="px-4 py-3 wrap">
                      <p class="text-sm font-medium">{{$lapor->email}}</p>
                  </td>
                  <td class="px-4 py-3 wrap">
                      <button title="Detail_laporan" data-nama="{{ $lapor->nama}}" data-detail="{{ $lapor->detail_laporan}}"data-email="{{ $lapor->email}}" data-tanggal="{{ $lapor->created_at->format('d M Y') }}" data-bukti="{{ $lapor->bukti ? asset('storage/' . $lapor->bukti) : ''}}" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-md shadow-lg hover:shadow-xl transition hover:from-blue-600 hover:to-blue-700 hover:cursor-pointer px-4 py-2 text-xs font-semibold">Detail</button>
                  </td>
                  <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <form method="POST" class="inline">
                      @csrf
                      @method('PUT')
                      <button class="action-btn text-green-600 hover:text-green-900 mr-2 hover:cursor-pointer" type="submit" title="Setujui">
                      <i class="fas fa-check"></i>
                      </button>
                    </form>
                  </td>
                </tr>
                @empty
                 <tr>
                    <td colspan="4" class="text-center text-gray-500 p-6">
                      Belum ada laporan
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <!-- ./LIST LAPORAN -->
      </div>

<!-- Modal Confirm -->
 <!--Blokir -->
  <x-modalconfirm identity="confirmationModalBlock" title="Blokir User" message="Apakah kamu yakin untuk memblokir user ini?">
    <x-button id="cancelBlock" onclick="cancelBlock()" color="primary" size="md">
      Batalkan
    </x-button>
    <x-button id="confirmBlockButton" color="warning" size="md">
      Blokir User
    </x-button>
  </x-modalconfirm>

  <!-- Delete User-->
  <x-modalconfirm identity="confirmationModalDelete" title="Hapus User" message="Apakah kamu yakin untuk menghapus user ini?">
    <x-button id="cancelDelete" onclick="cancelDelete()" color="primary" size="md">
      Batalkan
    </x-button>
    <x-button id="confirmDeleteButton" color="danger" size="md">
      Hapus User
    </x-button>
  </x-modalconfirm>

  <!-- Delete Produk -->
  <x-modalconfirm identity="confirmationModalDeleteProd" title="Hapus Postingan" message="Apakah kamu yakin untuk menghapus postingan ini?">
    <x-button id="cancelDeleteProd" onclick="cancelDeleteProd()" color="primary" size="md">
      Batalkan
    </x-button>
    <x-button id="confirmDeleteProdButton" color="danger" size="md">
      Hapus Postingan
    </x-button>
  </x-modalconfirm>

  <div id="modalLaporan" class="fixed inset-0 bg-black/50 items-center justify-center z-50 hidden">
  <div class="bg-white rounded-xl p-6 w-2xl h-80vh">
    <div class="flex justify-between items-baseline">
      <h2 class="text-2xl font-bold text-gray-800">Detail Laporan</h2>
    </div>
    <div class="flex flex-col gap-6">
      <div class="flex items-center flex-col">
        <img id="modal-bukti" src="" alt="Bukti Laporan" class="h-60 object-cover rounded-lg">
        <p id="foto-fallback" class="text-gray-500 mt-2 hidden">Tidak ada foto</p>
      </div>
      <div class="flex gap-2" id="detail_laporan">
        <h2 class="font-semibold">Detail laporan:</h2>
        <p id="modal-detail" class="text-md"></p>
      </div  >
      <div  class="flex flex-col">
        <p id="modal-nama" class="text-md capitalize font-semibold"></p>
        <p id="modal-email" class="text-md text-gray-500"></p>
      </div>
    <div class="mt-6 flex justify-end space-x-3">
      <x-button id="closeModalBtn" color="danger">
        Tutup
      </x-button>
    </div>
  </div>
</div>

<script>
  let currentBlockId = null;
  let currentDeleteId = null;
  let currentDeleteProdId = null;

  // Blokir User
  function blockUser(id) {
      currentBlockId = id;
      document.getElementById('confirmationModalBlock').classList.remove('hidden');
      document.getElementById('confirmationModalBlock').classList.add('flex');
  }

  // Konfirmasi Blokir
  document.getElementById('confirmBlockButton').onclick = function(e) {
      e.preventDefault();
      if (currentBlockId) {
          document.getElementById('blockForm-' + currentBlockId).submit();
      }
  }

  // Batalkan Blokir
  function cancelBlock() {
      document.getElementById("confirmationModalBlock").classList.remove('flex');
      document.getElementById("confirmationModalBlock").classList.add('hidden');
      currentDeleteId = null;
  }

  // Hapus User
  function deleteUser(id) {
      currentDeleteId = id;
      document.getElementById('confirmationModalDelete').classList.remove('hidden');
      document.getElementById('confirmationModalDelete').classList.add('flex');
  }

  // Konfirmasi Hapus
  document.getElementById('confirmDeleteButton').onclick = function(e) {
      e.preventDefault();
      if (currentDeleteId) {
          document.getElementById('deleteForm-' + currentDeleteId).submit();
      }
  }

  // Batalkan Hapus
  function cancelDelete() {
      document.getElementById("confirmationModalDelete").classList.remove('flex');
      document.getElementById("confirmationModalDelete").classList.add('hidden');
      currentDeleteId = null;
  }

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
      currentDeleteProdId = null;}
    
</script>

<script>
const fallbackText = document.getElementById('foto-fallback');
    const modalLaporan = document.getElementById('modalLaporan');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const detailButtons = document.querySelectorAll('[title="Detail_laporan"]');
    
    detailButtons.forEach(button => {
    button.addEventListener('click', function () {
      const nama = button.dataset.nama;
      const email = button.dataset.email;
      const bukti = button.dataset.bukti;
      const detail_laporan = button.dataset.detail;

      const imgElement = document.getElementById('modal-bukti');
      const namaEl = document.getElementById('modal-nama');
      const emailEl = document.getElementById('modal-email');
      const detailEl = document.getElementById('modal-detail');
      const detailTxt = document.getElementById('detail_laporan');

      namaEl.textContent = nama;
      emailEl.textContent = email;
      detailEl.textContent = detail_laporan;

      if (bukti == '') {
        imgElement.classList.add('hidden');
        imgElement.alt = 'Tidak ada foto';
        detailTxt.classList.add('flex-col');
        detailTxt.classList.remove('flex-row');
      } else {
        imgElement.src = bukti;
        imgElement.classList.remove('hidden');
        imgElement.alt = 'Bukti Laporan';
        detailTxt.classList.add('flex-row');
        detailTxt.classList.remove('flex-col');
      }

      modalLaporan.classList.remove('hidden');
      modalLaporan.classList.add('flex');
    });

  });

    closeModalBtn.addEventListener('click', function() {
      modalLaporan.classList.add('hidden');
    });
</script>

@endsection