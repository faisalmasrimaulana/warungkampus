<!-- LAYOUT -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="bg-gradient-to-br from-blue-50 to-blue-100">
        @include('partials.navbar')   

        <main>
            @yield('content')
        </main>

        <!-- Script -->
        @vite(['resources/js/app.js'])
    </body>
</html>