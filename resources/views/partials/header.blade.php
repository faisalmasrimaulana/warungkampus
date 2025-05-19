<!-- INI ADALAH PARTIAL DARI NAVBAR, BISA DITAMBAHKAN DENGAN FITUR LAIN -->

<header class="bg-green-600 text-white">
      <!-- Navbar -->
    <nav class="fixed top-0 left-0 w-full bg-white shadow p-4 z-50 flex items-center justify-between px-8 py-5">
      <!-- <div class="text-2xl font-bold text-[#1f2d4e] flex items-center">
        <span class="text-blue-500">W</span>arung<span class="text-blue-500">K</span>ampus
      </div> -->
      <x-logo></x-logo>
      <div class="space-x-4 flex items-center">
        <a href="{{url('/')}}">       
          <button id="homeButton" class="nav-button px-4 py-2 text-gray-600 hover:text-purple-500 hover:cursor-pointer">
            Beranda
          </button>
        </a>
        <a href="{{route('get.posting')}}">
          <button id="sellButton" class="nav-button px-4 py-2 text-gray-600 hover:text-blue-500 hover:cursor-pointer">
            Mulai Jual
          </button>
        </a>
        <a href="{{route('get.daftarproduk')}}">
          <button id="searchButton" class="nav-button px-4 py-2 text-gray-600 hover:text-green-500 hover:cursor-pointer">
            Cari Produk
          </button>
        </a>
        <!-- Profile Icon -->
        @guest
          <a href="{{route('login')}}"><x-button type="button" color="primary">Login</x-button></a>
          <a href="{{route('register')}}"><x-button type="button" color="secondary">Register</x-button></a>         
        @endguest
        @auth
        <button id="profileButton" class="ml-4">
          <img src="foto profil.jpg" alt="Profil" class="w-10 h-10 rounded-full border-2 border-blue-100 profile-img">
        </button>
        @endauth
      </div>
    </nav>

    <!-- Sidebar -->
    @auth
    <div id="profileSidebar" class="fixed top-0 right-0 h-full w-72 bg-white floating-sidebar transform translate-x-full transition-transform duration-300 z-50">
      <div class="p-6 h-full flex flex-col">
          <div class="flex items-center mb-8">
            <img src="foto profil.jpg" alt="Profil" class="w-12 h-12 rounded-full mr-3 border-2 border-blue-100">
            <div>
              <h3 class="font-semibold">M. Fauzi Gafar</h3>
              <p class="text-sm text-gray-500">Mahasiswa</p>
            </div>
          </div>
          <ul class="space-y-2 flex-grow">
            <li><a href="#" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">Profil Saya </a></li>
            <li><a href="#" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">Postingan Favorit </a></li>
            <li><a href="#" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">Riwayat </a></li>
            <li><a href="#" class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">Bantuan </a></li>
          </ul>
          <div class="pt-4 border-t border-gray-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-button type="submit" color="danger">Logout</x-button>
            </form>
            <!-- <a href="#" class="block px-4 py-3 rounded-lg text-red-600 hover:bg-red-50 transition">Logout </a> -->
          </div>
      </div>
    </div>
    @endauth
    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-black opacity-50 hidden z-40"></div>
</header>