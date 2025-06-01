@extends('layouts.app')

@section('content')
    <!-- MODAL KTM USER -->
    <x-modalktm/>

    <!-- MAIN CONTENT -->
    <div class="flex-1 overflow-y-auto p-6 mt-20">

      <!-- STATISTIK DASHBOARD -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- TOTAL PENGGUNA TERVERIFIKASI-->
        <div class="bg-gradient-to-br from-white to-slate-100 shadow transition-all duration-300 hover:-translate-y-1 hover:shadow-lg rounded-xl p-6">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-500">Total Pengguna</p>
              <h3 class="text-2xl font-bold text-gray-800">{{$totalUsers}}</h3>
              <p class="text-sm text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i> 12.5% dari bulan lalu</p>
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
              <p class="text-sm text-gray-500">Posting Aktif</p>
              <h3 class="text-2xl font-bold text-gray-800">{{$totalActiveProduct}}</h3>
              <p class="text-sm text-green-500 mt-1"><i class="fas fa-arrow-up mr-1"></i> 8.3% dari bulan lalu</p>
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
              <p class="text-sm text-red-500 mt-1"><i class="fas fa-arrow-down mr-1"></i> 5.2% dari bulan lalu</p>
            </div>
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
              <i class="fas fa-clock text-xl"></i>
            </div>
          </div>
        </div>
      </div>
      <!-- ./STATISTIK DASHBOARD -->


      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- AKTIVITAS TERKINI -->
        <div class="bg-white rounded-xl shadow-sm p-6">
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Aktivitas Terkini</h2>
            <a href="#" class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
          </div>
          <div class="space-y-4">
            <div class="flex items-start">
              <div class="p-2 rounded-full bg-blue-100 text-blue-600 mr-4">
                <i class="fas fa-user-plus"></i>
              </div>
              <div>
                <p class="text-sm font-medium">User baru mendaftar</p>
                <p class="text-xs text-gray-500">Faisal Masri Maulana mendaftar</p>
                <p class="text-xs text-gray-400 mt-1">2 menit yang lalu</p>
              </div>
            </div>
            <div class="flex items-start">
              <div class="p-2 rounded-full bg-green-100 text-green-600 mr-4">
                <i class="fas fa-check-circle"></i>
              </div>
              <div>
                <p class="text-sm font-medium">Posting baru diverifikasi</p>
                <p class="text-xs text-gray-500">"Buku Kalkulus edisi terbaru" telah disetujui</p>
                <p class="text-xs text-gray-400 mt-1">15 menit yang lalu</p>
              </div>
            </div>
            <div class="flex items-start">
              <div class="p-2 rounded-full bg-red-100 text-red-600 mr-4">
                <i class="fas fa-trash-alt"></i>
              </div>
              <div>
                <p class="text-sm font-medium">Posting dihapus</p>
                <p class="text-xs text-gray-500">"Jasa pembuatan skripsi" dihapus karena melanggar</p>
                <p class="text-xs text-gray-400 mt-1">1 jam yang lalu</p>
              </div>
            </div>
          </div>
        </div>
        <!-- ./AKTIVITAS TERKINI -->

        <!-- WAITING LIST UNVERIFIED USER -->
        <div class="bg-white rounded-xl shadow-sm p-6">
          <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Verifikasi User</h2>
            <a href="{{route('admin.user.kelola')}}" class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
          </div>
          @if(!$users->isEmpty())
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
              <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $user )
                <tr class="hover:bg-gray-100">
                  <td class="px-4 py-3 whitespace-nowrap">
                    <div class="flex items-center">
                      <img class="w-8 h-8 rounded-full mr-3" src="{{ $user->foto_profil != 'fotoprofil.jpg' ? asset('storage/' . $user->foto_profil) : 'https://ui-avatars.com/api/?background=3b82f6&color=fff'" alt="User">
                      <div>
                        <p class="text-sm font-medium">{{$user->nama}}</p>
                        <p class="text-xs text-gray-500">{{$user->email}}</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-4 py-3 whitespace-nowrap">
                    @if($user->is_verified==0)
                    <x-badge status="pending"></x-badge>
                    @else
                    <x-badge status="verified"></x-badge>
                    @endif
                  </td>
                  <td class="px-4 py-3 whitespace-nowrap">
                    <x-button class="view-ktm-btn" size="sm" data-ktm="{{asset('storage/' . $user->ktm)}}" data-name="{{$user->nama}}" data-email="{{$user->email}}" data-date="{{$user->created_at->diffForHumans()}}">
                      Lihat KTM
                    </x-button>
                  </td>
                  @if(!$user->is_verified)
                  <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <form action="{{ route('admin.user.verifikasi', $user->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                        <button class="action-btn text-green-600 hover:text-green-900 mr-2 hover:cursor-pointer" type="submit" title="Setujui">
                        <i class="fas fa-check"></i>
                        </button>
                    </form>
                    <form action="{{ route('admin.user.hapus', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="action-btn text-red-600 hover:text-red-900 hover:cursor-pointer" type="submit" title="Tolak">
                        <i class="fas fa-times"></i></button>
                    </form>
                  </td>
                  @else
                  <td class="px-2 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button class="action-btn text-blue-600 hover:text-blue-900 mr-3" title="Detail">
                      <i class="fas fa-eye"></i>
                    </button>
                    <button class="action-btn text-yellow-600 hover:text-red-900 mr-3" title="Blokir">
                      <i class="fas fa-ban"></i>
                    </button>
                    <form action="{{ route('admin.user.hapus', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="action-btn text-red-600 hover:text-red-900" title="Hapus" type="submit">
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
          @endif
        </div>
        <!-- ./WAITING LIST UNVERIFIED USER -->
      </div>
@endsection