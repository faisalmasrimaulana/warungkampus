<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Register</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('WK.ico') }}">
        <!-- Fonts -->
         <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

<body class="min-h-screen">

    <div class="flex flex-col items-center justify-center min-h-screen py-8 px-4 sm:px-6 lg:px-8">
        <!-- TITLE -->
        <div class="w-full max-w-2xl space-y-6 mb-5">
            <div class="text-center">
                <div class="inline-block bg-gradient-to-r from-blue-400 to-blue-600 text-white px-4 py-2 rounded-full text-sm mb-4 shadow-lg">
                    ✨ Marketplace Mahasiswa Pertama di Jambi ✨
                </div>
                <h2 class="text-3xl font-bold text-[#1f2d4e] glow-text">
                    Buat<span class="text-blue-500"> Akun Baru</span> <br>
                    <span class="text-blue-500">W</span>arung<span class="text-blue-500">K</span>ampus
                </h2>
                <p class="mt-2 text-gray-600">
                    Lengkapi data berikut untuk mendaftar sebagai anggota di WarungKampus
                </p>
            </div>
        </div>
        <!-- ./TITLE -->

        <!-- FORM REGISTER -->
        <x-formcard action="{{ route('user.register.store') }}" method="POST" enctype="multipart/form-data">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- KOLOM KIRI: nim, nama, email, wa, ig -->
                <div class="space-y-5">
                    <x-input id="nim" label="NIM*" name="nim" type="text" placeholder="Masukkan NIM Anda" :autofocus="true"/>

                    <x-input id="nama" label="Nama Lengkap*" name="nama" type="text" placeholder="Masukkan Nama Lengkap Anda*"/>
                    
                    <x-input id="email" label="Email*" name="email" type="text" placeholder="email@example.com"/>

                    <x-input id="whatsapp" label="Whatsapp*" name="whatsapp" pattern="^62\d{8,15}$" type="text" placeholder="62812345678"/>
                    
                    <label for="instagram" pattern="^[^@ \t\r\n][a-zA-Z0-9._]" class="block text-sm font-medium text-gray-700 mb-1">Username Instagram</label>
                    <div class="flex">
                        <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">@
                        </span>
                        <x-input id="instagram" name="instagram" type="text" placeholder="instagram"/>
                    </div>
                </div>
                
                <!-- KOLOM KANAN: ktm, alamat, password -->
                <div class="space-y-5">
                    <div>
                        <label for="ktm" class="block text-sm font-medium text-gray-700 mb-1">Kartu Tanda Mahasiswa*</label>
                        <label for="ktm" class="file-label">
                            <div class="text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="mt-1 text-sm text-gray-600">
                                <span class="font-medium text-blue-600">Unggah file</span> atau drag and drop
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                Format: JPG, PNG (maks. 3MB)
                            </p>
                            </div>
                        </label>
                        <input type="file" id="ktm" name="ktm" accept="image/*" class="file-input">
                        @error('ktm')
                        <p class="text-xs text-red-500">{{$message}}</p>
                        @enderror
                        <div id="file-name" class="text-xs text-gray-500 mt-1 truncate"></div>
                    </div>
                    
                    <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat*</label>
                    <textarea id="alamat" name="alamat" rows="2"
                                class="input-field w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 sm:text-sm"
                                placeholder="Alamat lengkap (termasuk asrama/kos jika ada)">{{old('alamat')}}</textarea>
                    @error('alamat')
                        <p class="text-xs text-red-500">{{$message}}</p>
                    @enderror
                    </div>
                    
                    <x-input id="password" name="password" type="password" placeholder="Minimal 8 karakter" label="Kata Sandi*"/>
                    
                    <div>
                    <x-input id="password_confirmation" name="password_confirmation" type="password" placeholder="Ketik ulang kata sandi" label="Konfirmasi Kata Sandi*"/>
                    </div>
                </div>
            </div>

            <!-- BUTTON REGISTER -->
            <x-button type="submit" class="relative w-full flex justify-center" color="primary">
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-300 group-hover:text-blue-200" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                </svg>
                </span>
                Daftar Sekarang
            </x-button>
            <x-button href="{{route('home')}}" color="danger" class="w-full flex"><span class="justify-center w-full">Batal</span></x-button>

            <!-- BUTTON LOGIN -->
            <div class="mt-6 text-center text-sm">
                <p class="text-gray-600">
                Sudah punya akun? 
                <a href="{{route('login')}}" class="font-medium text-blue-600 hover:text-blue-500">
                    Masuk disini
                </a>
            </p>
            </div>
        </x-formcard>
        <!-- ./FORM REGISTER -->
    </div>

    <script>
    // MENAMPILKAN Nama File KTM
    document.getElementById('ktm').addEventListener('change', function(e) {
        const fileName = document.getElementById('file-name');
        if (this.files.length > 0) {
        fileName.textContent = this.files[0].name;
        } else {
        fileName.textContent = '';
        }
    });
    </script>

</body>
</html>