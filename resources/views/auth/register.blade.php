<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Register</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <!-- x-button merupakan sebuah komponen, untuk settingnya bisa di cek di views/component/button-->
    <body>
        <main>
            <h1 class="text-center text-2xl font-semibold text-green-900 py-5">WarungKampus</h1>
            <div class="flex justify-center items-center">
                <form action="{{ route('register.store') }}" method="POST" class="w-1/3 bg-white  rounded-md relative p-4 drop-shadow-xl focus-within:drop-shadow-green-300 drop-shadow-black-400 mb-7" enctype="multipart/form-data">
                    <h1 class="text-green-800 font-bold pb-4 text-center uppercase">Form Pendaftaran</h1>
                    @csrf
                    <!-- NIM -->
                    <label for="nim" class="text-sm text-green-900 font-semibold">NIM</label>
                    <x-input type="text" id="nim" name="nim" placeholder="Masukkan NIM" class="uppercase"></x-input>

                    <!-- Nama Lengkap -->
                    <label for="nama" class="text-sm text-green-900 font-semibold">Nama Lengkap</label>
                    <x-input type="text" name="nama" placeholder="Nama Anda" class="capitalize"></x-input>

                    <!-- email -->
                    <label for="email" class="text-sm text-green-900 font-semibold">Email</label>
                    <x-input type="email" name="email" placeholder="email@gmail.com" class="lowercase"></x-input>

                    <!-- whatsapp -->
                    <label for="whatsapp" class="text-sm text-green-900 font-semibold">Whatsapp</label>
                    <x-input type="tel" id="whatsapp" name="whatsapp" placeholder="08123456789"></x-input>

                    <!-- instagram -->
                    <label for="instagram" class="text-sm text-green-900 font-semibold">Instagram</label>
                    <x-input type="text" name="instagram" placeholder="@instagram" class="lowercase"></x-input>

                    <!-- foto ktm -->
                    <label for="ktm" class="text-sm text-green-900 font-semibold">KTM</label>
                    <input type="file" accept="image/*" name="ktm" class="border text-sm p-2 rounded-md border-green-500 w-full mb-3"></input>

                    <!-- alamat -->
                    <label for="alamat" class="text-sm text-green-900 font-semibold">Alamat</label>
                    <x-input type="text" name="alamat" placeholder="Muaro Jambi, Provinsi Jambi"></x-input>

                    <!-- password -->
                    <label for="password" class="text-sm text-green-900 font-semibold">Kata Sandi</label>
                    <x-input type="password" name="password" placeholder="12Wk1"></x-input>

                    <!-- konfirmasi password -->
                    <label for="password_confirmation" class="text-sm text-green-900 font-semibold">Konfirmasi Kata Sandi</label>
                    <x-input type="password" name="password_confirmation" placeholder="Ulangi Kata Sandi"></x-input>

                    <!-- Submit dan cancel button -->
                    <div class="loginButton inline-flex justify-end w-full gap-3">
                        <x-button type="submit" color="primary">Mendaftar</x-button>
                        <a href="{{'cancel'}}" ><x-button type="button" color="danger">Batal</x-button></a>
                    </div>
                </form>
            </div>
        </main>
    </body>
</html>