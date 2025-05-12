@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mt-5 text-xl font-bold">Ini dashboard Admin</h1>
    @if(!$users->isEmpty())
    <!-- TABEL USER -->
    <!-- x-button merupakan sebuah komponen, untuk settingnya bisa di cek di views/component/button-->
    <table>
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Whatsapp</th>
                <th class="w-60">KTM</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->nim }}</td>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->whatsapp }}</td>
                <td>{{ $user->instagram }}</td>

                <!-- FOTO KTM -->
                <td>
                    <img src="{{ asset('storage/' . $user->ktm) }}"
                        alt="KTM"
                        class="h-24 text-center object-cover rounded-md border border-green-400 cursor-pointer"
                        onclick="showModal(`{{ asset('storage/' . $user->ktm) }}`)">
                </td>
                <!-- /FOTO KTM -->

                <!-- TOMBOL VERIFIKASI DAN HAPUS -->
                <td>
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
                </td>
                <!-- /TOMBOL VERIFIKASI DAN HAPUS -->
            </tr>
            @endforeach
        </tbody>
    </table>
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