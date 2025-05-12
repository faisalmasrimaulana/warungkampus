@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mt-5 text-xl font-bold">Ini dashboard Admin</h1>
    @if(!$users->isEmpty())
    <!-- TABEL USER -->
    <!-- x-button merupakan sebuah komponen, untuk settingnya bisa di cek di views/component/button-->
     <div class="flex w-full justify-center">
         <table class="border-collapse border border-black table-auto p-2">
             <thead>
                 <tr>
                     <th class="border border-black p-2">NIM</th>
                     <th class="border border-black p-2">Nama</th>
                     <th class="border border-black p-2">Email</th>
                     <th class="border border-black p-2">Whatsapp</th>
                     <th class="border border-black p-2">Instagram</th>
                     <th class="w-60 border border-black p-2">KTM</th>
                     <th class="border border-black p-2">Aksi</th>
                 </tr>
             </thead>
             <tbody>
                 @foreach($users as $user)
                 <tr>
                     <td class="border border-black p-2">{{ $user->nim }}</td>
                     <td class="border border-black p-2">{{ $user->nama }}</td>
                     <td class="border border-black p-2">{{ $user->email }}</td>
                     <td class="border border-black p-2">{{ $user->whatsapp }}</td>
                     <td class="border border-black p-2">{{ $user->instagram }}</td>
     
                     <!-- FOTO KTM -->
                     <td class=" border-black justify-center flex p-2">
                         <img src="{{ asset('storage/' . $user->ktm) }}"
                             alt="KTM"
                             class="h-24 object-cover rounded-md border border-green-400 cursor-pointer"
                             onclick="showModal(`{{ asset('storage/' . $user->ktm) }}`)">
                     </td>
                     <!-- /FOTO KTM -->
     
                     <!-- TOMBOL VERIFIKASI DAN HAPUS -->
                     <td class="border border-black p-2 ">
                         <div class="flex flex-col items-center gap-2">
                             <form action="{{ route('admin.verifikasi', $user->id) }}" method="POST" class="inline">
                                 @if(!$user->is_verified)
                                     @csrf
                                     @method('PUT')
                                     <x-button type="submit" color="primary">Verifikasi</x-button> 
                                 @else
                                 <x-button type="submit" color="nonactive">Terverifikasi</x-button>
                                 @endif
                             </form>
                             <form action="{{ route('admin.hapus', $user->id) }}" method="POST" class="inline">
                                 @csrf
                                 @method('DELETE')
                                 <x-button type="submit" color="danger">Hapus</x-button>
                             </form>
                         </div>
                     </td>
                     <!-- /TOMBOL VERIFIKASI DAN HAPUS -->
                 </tr>
                 @endforeach
             </tbody>
         </table>
     </div>
    <!-- Modal untuk foto ktm yang ketika di klik-->
    <div id="ktmModal" class="fixed inset-0 bg-black bg-opacity-70 hidden justify-center items-center z-50">
        <div class="bg-white p-4 rounded-lg shadow-lg relative max-w-md w-full">
            <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-600 hover:text-red-500 hover:cursor-pointer text-xl">&times;</button>
            <img id="ktmImage" src="" alt="Preview KTM" class="w-full h-auto object-contain rounded">
        </div>
    </div>
    @endif
</div>

<!-- SCRIPT UNTUK MENAMPILKAN MODAL      -->
<script>
    function showModal(imageSrc) {
        const modal = document.getElementById('ktmModal');
        const image = document.getElementById('ktmImage');
        image.src = imageSrc;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        const modal = document.getElementById('ktmModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
</script>
@endsection