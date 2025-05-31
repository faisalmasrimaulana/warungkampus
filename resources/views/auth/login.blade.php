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

    <body class="min-h-screen">
        <div class="flex flex-col items-center justify-center min-h-screen py-12 px-4 sm:px-6 lg:px-8">
            <div class="w-full max-w-md space-y-8">
                <!-- TITLE -->
                <div class="text-center">
                    <div class="inline-block bg-gradient-to-r from-blue-400 to-blue-600 text-white px-4 py-2 rounded-full text-sm mb-6 shadow-lg">
                        ✨ Marketplace Mahasiswa Pertama di Jambi ✨
                    </div>
                    <h2 class="mt-6 text-3xl font-bold text-[#1f2d4e] glow-text">
                        Login ke <x-logo></x-logo>
                    </h2>
                    <p class="mt-2 text-gray-600">
                        Gunakan Email dan kata sandi Anda untuk mengakses akun
                    </p>
                </div>
                <!-- ./TITLE -->
                    
                <!-- FORM LOGIN -->
                <x-formcard action="{{route('login.submit')}}" method="POST">

                    <!-- INPUT -->
                    <div class="space-y-4">
                        <x-input id="email" label="Email" name="email" type="text" placeholder="Masukkan Email Anda" autocomplete="email" :autofocus="true"/>
                        <x-input id="password" label="Password" name="password" type="password" autocomplete="current-password" placeholder="Masukkan kata sandi"/>
                    </div>
                     
                    <!-- REMEMBER ME -->
                    <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                        Ingat saya
                        </label>
                    </div>

                    <!-- LUPA KATA SANDI -->
                    <div class="text-sm">
                        <a href="#" class="font-medium text-blue-600 hover:text-blue-500">
                        Lupa kata sandi?
                        </a>
                    </div>
                    </div>

                    <!-- LOGIN BUTTON -->
                    <x-button type="submit" color="primary" class="group relative w-full flex justify-center">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-blue-300 group-hover:text-blue-200" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                        </span>
                        Masuk
                    </x-button>
                    <x-button href="{{route('home')}}" color="danger" class="w-full flex"><span class="justify-center w-full">Batal</span></x-button>

                    <!-- REGIS BUTTON -->
                    <div class="mt-6">
                        <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">
                            Belum punya akun?
                            </span>
                        </div>
                        </div>
    
                        <div class="mt-4">
                        <x-button href="{{route('user.register')}}"
                                class="group relative w-full flex justify-center" color="secondary">
                            Daftar Akun Baru</x-button>
                        </div>
                    </div>
                </x-formcard>
                <!-- ./FORM LOGIN -->
                
            </div>
        </div>

    </body>
</html>