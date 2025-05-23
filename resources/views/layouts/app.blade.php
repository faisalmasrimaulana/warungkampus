<!-- LAYOUT -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
            @include('partials.head'); 
        <style>
            body {
            font-family: 'Poppins', sans-serif;
            }
            .floating-sidebar {
            box-shadow: -5px 0 25px rgba(0, 0, 0, 0.08);
            }
        </style>
        
    </head>
    <body class="bg-blue-50">
        @include('partials.navbar')   

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
        <script>
        feather.replace()
        </script>
    </body>
</html>