<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <main class="flex justify-center h-dvh flex-col">
            <h1 class="text-center text-2xl font-semibold text-green-900 py-5">WarungKampus</h1>
            <div class="flex justify-center items-center">
                <form action="{{route('loginadmin.submit')}}" method="POST" class="w-1/3 bg-white  rounded-md relative p-4 drop-shadow-xl focus-within:drop-shadow-green-300 drop-shadow-black-400 mb-7">
                    <h1 class="text-green-800 font-bold pb-4 text-center uppercase">Form Login Admin</h1>
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

                    <label for="admin_id" class="text-sm text-green-900 font-semibold">Admin Id</label>
                    <x-input type="text" name="admin_id" placeholder="admin000" class="lowercase" required></x-input>

                    <label for="password" class="text-sm text-green-900 font-semibold">Kata Sandi</label>
                    <x-input type="password" name="password" placeholder="12Wk1" required></x-input>

                    <div class="loginButton inline-flex justify-end w-full gap-3">
                        <x-button type="submit" color="primary">Masuk</x-button>
                        <a href="{{'cancel'}}" ><x-button type="button" color="danger">Batal</x-button></a>
                    </div>
                </form>
            </div>
        </main>
    </body>
</html>