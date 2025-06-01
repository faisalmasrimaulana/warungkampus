@extends('layouts.app')
@section('content')

    <!-- KTM Modal -->
    <x-modalktm/>

    <section class="flex-1 overflow-y-auto p-6 mt-20">
      <!-- FILTER DAN PENCARIAN -->
      <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
          <div class="w-full md:w-1/3">
            <input type="text" placeholder="Cari user..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
          </div>
          <div class="flex flex-col sm:flex-row gap-3">
            <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
              <option value="">Semua Status</option>
              <option value="active">Aktif</option>
              <option value="pending">Menunggu</option>
              <option value="banned">Diblokir</option>
            </select>
          </div>
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
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">KTM</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bergabung</th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($users as $user )
                <tr class="table-row">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <img class="w-10 h-10 rounded-full mr-4" src="{{ $user->foto_profil != 'fotoprofil.jpg' ? asset('storage/' . $user->foto_profil) :'https://ui-avatars.com/api/?background=3b82f6&color=fff'" alt="User">
                      <div>
                        <p class="text-sm font-medium">{{$user->nama}}</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$user->email}}</td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <x-button size="sm" class="view-ktm-btn" data-name="{{$user->nama}}" data-email="{{$user->email}}" data-ktm="{{asset('storage/' . $user->ktm)}}" data-date="{{$user->created_at}}">
                      Lihat KTM
                    </x-button>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    @if($user->is_verified)
                      <x-badge status="verified"></x-badge>
                    @else
                      <x-badge status="pending"></x-badge>
                    @endif
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$user->created_at->format('d M Y')}}</td>

                  @if(!$user->is_verified)
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <form action="{{ route('admin.user.verifikasi', $user->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                        <button class=" text-green-600 hover:text-green-900 mr-2 hover:cursor-pointer" type="submit" title="Setujui">
                        <i class="fas fa-check"></i>
                        </button>
                    </form>
                    <form action="{{ route('admin.user.hapus', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class=" text-red-600 hover:text-red-900 hover:cursor-pointer" type="submit" title="Tolak">
                        <i class="fas fa-times"></i></button>
                    </form>
                  </td>
                  @else
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button class=" text-blue-600 hover:text-blue-900 mr-3" title="Detail">
                      <i class="fas fa-eye"></i>
                    </button>
                    <button class=" text-yellow-600 hover:text-red-900 mr-3" title="Blokir">
                      <i class="fas fa-ban"></i>
                    </button>
                    <button class=" text-red-600 hover:text-red-900" title="Blokir">
                      <i class="fas fa-trash"></i>
                    </button>
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
@endsection