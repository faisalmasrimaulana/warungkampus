<!-- LAYOUT -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
            @include('partials.head')
        <style>
            body{
                background: linear-gradient(135deg, rgb(240, 244, 255), rgb(230, 240, 255));
            }
        </style> 
    </head>
    <body class="bg-blue-50">
        @include('partials.navbar')   

        <main>
            @yield('content')
        </main>

        <!-- Script -->
        @vite(['resources/js/app.js'])
    </body>
</html>