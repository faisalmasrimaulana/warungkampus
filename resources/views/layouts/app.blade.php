<!-- LAYOUT -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>]
        <script src="https://unpkg.com/feather-icons"></script>

        <!-- Fonts -->
        <!-- <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" /> -->
        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
          <style>
            body {
            font-family: 'Poppins', sans-serif;
            }
            .floating-sidebar {
            box-shadow: -5px 0 25px rgba(0, 0, 0, 0.08);
            }
            .nav-button {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            }
            .nav-button::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: currentColor;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
            }
            .nav-button:hover::after {
            transform: scaleX(1);
            transform-origin: left;
            }
            .nav-button.home-active {
            color: #9333ea;
            font-weight: 500;
            }
            .nav-button.sell-active {
            color: #3b82f6;
            font-weight: 500;
            }
            .nav-button.search-active {
            color: #10b981;
            font-weight: 500;
            }
            .nav-button.active::after {
            transform: scaleX(1);
            }
            .profile-img {
            transition: all 0.3s ease;
            }
            .profile-img:hover {
            transform: scale(1.05);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
            }
        </style>
    </head>
    <body class="bg-blue-50">
        @include('partials.header')   

        <main>
            @yield('content')
        </main>

        <!-- Script -->
        <script>
        // Sidebar toggle
        const profileButton = document.getElementById('profileButton');
        const profileSidebar = document.getElementById('profileSidebar');
        const overlay = document.getElementById('overlay');

        profileButton.addEventListener('click', () => {
            profileSidebar.classList.remove('translate-x-full');
            overlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        });

        overlay.addEventListener('click', () => {
            profileSidebar.classList.add('translate-x-full');
            overlay.classList.add('hidden');
            document.body.style.overflow = 'auto';
        });

        // Navigation logic
        const homeButton = document.getElementById('homeButton');
        const sellButton = document.getElementById('sellButton');
        const searchButton = document.getElementById('searchButton');

        homeButton.addEventListener('click', () => {
            window.location.href = 'beranda.html';
        });

        sellButton.addEventListener('click', () => {
            window.location.href = 'posting.html';
        });

        searchButton.addEventListener('click', () => {
            window.location.href = 'pencarian.html';
        });
        </script>

        <script src="https://unpkg.com/feather-icons"></script>
    </body>
</html>