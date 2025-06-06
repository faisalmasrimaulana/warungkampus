@extends('layouts.app')
@section('content')
    <style>
      .stat-card {
      transition: all 0.3s ease;
      background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }
    .stat-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    .table-row:hover {
      background-color: #f1f5f9;
    }
    .badge {
      font-size: 0.75rem;
      padding: 0.25rem 0.5rem;
      border-radius: 9999px;
    }
    .badge-pending {
      background-color: #fef3c7;
      color: #92400e;
    }
    .badge-active {
      background-color: #d1fae5;
      color: #065f46;
    }
    .badge-rejected {
      background-color: #fee2e2;
      color: #991b1b;
    }
    .action-btn {
      transition: all 0.2s ease;
    }
    .action-btn:hover {
      transform: scale(1.1);
    }
    </style>
    <!-- KTM Modal -->
    <x-modalktm/>

    <section class="flex-1 overflow-y-auto p-6 mt-20">
              <!-- FILTER DAN SEARCH -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex flex-col w-full sm:flex-row">
              <form action="{{route('admin.user.filter')}}" method="GET" class="flex w-full justify-between">
                <div class="flex space-x-2">
                  <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari User..." class="search-input px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                  <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-magnifying-glass mr-2"></i>Cari
                  </button>
                </div>

                <div class="flex space-x-2">
                  <select name="verifikasi" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Verifikiasi</option>
                    <option value="true" {{ request('verifikasi') == 'true' ? 'selected' : '' }}>Terverifikasi</option>
                    <option value="false" {{ request('verifikasi') == 'false' ? 'selected' : '' }}>Belum diverifikasi</option>
                  </select>
                  <select name="blokir" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Blokir</option>
                    <option value="true" {{ request('blokir') == 'true' ? 'selected' : '' }}>Diblokir</option>
                    <option value="false" {{ request('blokir') == 'false' ? 'selected' : '' }}>Aman</option>
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

      <!-- TABEL USERS -->
      <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b">
          <h2 class="text-lg font-semibold text-gray-800">Daftar User</h2>
          <div class="flex items-center space-x-2">
          </div>
        </div>
        
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class=" pl-6  py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                <th scope="col" class="  py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th scope="col" class=" py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">KTM</th>
                <th scope="col" class="py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th scope="col" class=" py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bergabung</th>
                <th scope="col" class="py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $user )
                <tr class="table-row">
                  <td class="pl-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <img class="w-10 h-10 rounded-full mr-4" src="{{ $user->foto_profil != 'fotoprofil.jpg' ? asset('storage/' . $user->foto_profil) :'https://ui-avatars.com/api/?background=3b82f6&color=fff'}}" alt="User">
                      <div>
                        <p class="text-sm font-medium">{{$user->nama}}</p>
                      </div>
                    </div>
                  </td>
                  <td class="py-4 whitespace-nowrap text-sm text-gray-500">{{$user->email}}</td>
                  <td class="py-4 whitespace-nowrap">
                    <x-button size="sm" class="view-ktm-btn" data-name="{{$user->nama}}" data-email="{{$user->email}}" data-ktm="{{asset('storage/' . $user->ktm)}}" data-date="{{$user->created_at}}">Lihat KTM</x-button>
                  </td>
                  <td class="py-3 whitespace-nowrap">
                    @if($user->is_verified==0)
                    <x-badge status="pending"></x-badge>
                    @elseif($user->is_blocked==1)
                    <x-badge status="blocked"></x-badge>
                    @else
                    <x-badge status="verified"></x-badge>
                    @endif
                  </td>
                  <td class="py-4 whitespace-nowrap text-sm text-gray-500">{{$user->created_at->format('d M Y')}}</td>

                  @if(!$user->is_verified)
                  <td class="py-4 whitespace-nowrap text-left text-sm font-medium">
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
                  @else
                  <!-- KELOLA USER -->
                  <td class="py-4 whitespace-nowrap text-left text-sm font-medium">
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
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        
        <!-- PAGINATION -->
        <div class="flex items-center justify-between px-6 py-4 border-t">
          <div class="text-sm text-gray-500">
            Menampilkan <span class="font-medium">{{$users->firstItem()}}</span> sampai <span class="font-medium">{{$users->lastItem()}}</span> dari <span class="font-medium">{{$users->total()}}</span> user
          </div>
          <div class="mt-4 px-6">{{$users->links()}}</div>
        </div>

      </div>
    </section>

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

  <!-- Delete -->
  <x-modalconfirm identity="confirmationModalDelete" title="Hapus User" message="Apakah kamu yakin untuk menghapus user ini?">
    <x-button id="cancelDelete" onclick="cancelDelete()" color="primary" size="md">
      Batalkan
    </x-button>
    <x-button id="confirmDeleteButton" color="danger" size="md">
      Hapus User
    </x-button>
  </x-modalconfirm>

<script>
  let currentBlockId = null;
  let currentDeleteId = null;

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
</script>
@endsection