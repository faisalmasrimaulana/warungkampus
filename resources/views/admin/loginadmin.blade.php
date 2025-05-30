<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

        <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <!-- x-button merupakan sebuah komponen, untuk settingnya bisa di cek di views/component/button-->
    <body class="login-gradient min-h-screen">
        <div class="flex flex-col items-center justify-center min-h-screen py-12 px-4 sm:px-6 lg:px-8">
            <div class="w-full max-w-md space-y-8">
                <div class="text-center">
                    <div class="inline-block bg-gradient-to-r from-blue-400 to-blue-600 text-white px-4 py-2 rounded-full text-sm mb-6 shadow-lg">
                        ✨ Marketplace Mahasiswa Pertama di Jambi ✨
                    </div>
                    <h2 class="mt-6 text-3xl font-bold text-[#1f2d4e] glow-text">
                        Login sebagai admin ke <x-logo></x-logo>
                    </h2>
                    <p class="mt-2 text-gray-600">
                        Gunakan AdminId dan kata sandi Anda untuk mengakses akun
                    </p>
                </div>
                    
            <div class="login-card rounded-2xl p-8">
                <form class="mt-8 space-y-6" action="{{route('admin.login.submit')}}" method="POST">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="rounded-md shadow-sm space-y-4">
                        <div>
                            <label for="admin_id" class="block text-sm font-medium text-gray-700 mb-1">Admin Id</label>
                            <x-input id="admin_id" name="admin_id" type="text" placeholder="Masukkan Admin Id Anda"/>
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                            <x-input id="password" name="password" type="password" autocomplete="current-password" placeholder="Masukkan kata sandi"/>
                        </div>
                    </div>

                    <div>
                        <x-button type="submit" color="primary" class="group relative w-full flex justify-center">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-blue-300 group-hover:text-blue-200" xmlns="http://www.w3.org/2000/svg" 
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                            </span>
                            Masuk
                        </x-button>
                    </div>
                        <x-button href="{{route('home')}}" color="danger" class="w-full flex"><span class="justify-center w-full">Batal</span></x-button>
                </form>
            </div>
        </div>
    </body>
</html>