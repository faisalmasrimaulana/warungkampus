@extends('layouts.app')

@section('content')
  <style>
    body {
      font-family: 'Poppins', sans-serif;
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
    .nav-button.active {
      color: #8b5cf6;
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
  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('hidden');
    }
  </script>
    <!-- Navbar akan dimuat di sini -->
    <div id="navbar-placeholder"></div>

    <div id="navbar-placeholder"></div>

    <div class="mt-[88px]"></div>

    <div id="overlay" class="fixed inset-0 bg-black opacity-50 hidden z-40"></div>

    <div class="flex items-center space-x-4 px-8 py-4 bg-blue-50">
        <button onclick="toggleSidebar()" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600">
        Filter
        </button>
        <div class="relative flex-1">
        <input type="text" placeholder="Cari produk..." class="w-full px-4 py-2 pr-10 rounded border border-gray-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 17a6 6 0 100-12 6 6 0 000 12z" />
        </svg>
        </div>
    </div>
    <!-- SIDEBAR -->
    <div id="sidebar" class="hidden absolute z-10 top-[110px] left-8 w-64 bg-white border rounded shadow-lg p-4">
        <div class="flex justify-end mb-4">
        <button onclick="toggleSidebar()" class="text-sm text-red-600 hover:underline">✖</button>
        </div>

        <h2 class="text-lg font-semibold mb-2">Kategori</h2>
        <ul id="kategori-list" class="space-y-2 mb-4 text-blue-800">
        <li>
            <label class="cursor-pointer flex items-center space-x-2 rounded px-2 py-1 hover:bg-blue-100">
            <input type="radio" name="kategori" class="kategori-radio hidden" value="Barang">
            <span>Barang</span>
            </label>
        </li>
        <li>
            <label class="cursor-pointer flex items-center space-x-2 rounded px-2 py-1 hover:bg-blue-100">
            <input type="radio" name="kategori" class="kategori-radio hidden" value="Jasa">
            <span>Jasa</span>
            </label>
        </li>
        </ul>

        <h2 class="text-lg font-semibold mb-2">Urutkan Harga</h2>
        <ul id="harga-list" class="space-y-2 mb-4 text-blue-800">
        <li><a href="#" data-value="Terendah" class="urut-harga block rounded px-2 py-1 hover:bg-blue-100 cursor-pointer">Terendah</a></li>
        <li><a href="#" data-value="Tertinggi" class="urut-harga block rounded px-2 py-1 hover:bg-blue-100 cursor-pointer">Tertinggi</a></li>
        </ul>

        <h2 class="text-lg font-semibold mb-2">Urutkan Waktu</h2>
        <ul id="waktu-list" class="space-y-2 text-blue-800 mb-4">
        <li><a href="#" data-value="Terbaru" class="urut-waktu block rounded px-2 py-1 hover:bg-blue-100 cursor-pointer">Terbaru</a></li>
        <li><a href="#" data-value="Terlama" class="urut-waktu block rounded px-2 py-1 hover:bg-blue-100 cursor-pointer">Terlama</a></li>
        </ul>

        <div class="flex justify-end space-x-2">
        <button onclick="toggleSidebar()" class="bg-gray-300 text-black px-3 py-1 rounded hover:bg-gray-400">Batal</button>
        <button class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Oke</button>
        </div>
  </div>

  <!-- ./SIDEBAR -->
  <main class="p-6">

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
    @foreach($product as $prod)
      <a href="{{ route('get.detail', ['id' => $prod->id]) }}">
        <div class="bg-white rounded-lg shadow-sm overflow-hidden transition-transform hover:scale-[1.02]">
          <img src="{{ asset('storage/' . ($prod->fotoproduk->first()->path_fotoproduk ?? 'default.jpg')) }}" alt="{{ $prod->nama_produk }}" class="w-full h-32 object-cover">
          <div class="p-3">
            <h3 class="text-sm font-semibold truncate">{{ $prod->nama_produk }}</h3>
            <p class="text-xs text-gray-500">{{ $prod->kategori }}</p>
            <p class="text-sm text-blue-700 font-bold mt-1">Rp {{ number_format($prod->harga, 0, ',', '.') }}</p>
          </div>
        </div>
      </a>
    @endforeach

</div>

  </main>
    <script>
    const hargaItems = document.querySelectorAll('.urut-harga');
    hargaItems.forEach(item => {
      item.addEventListener('click', (e) => {
        e.preventDefault();
        hargaItems.forEach(i => i.classList.remove('bg-blue-200', 'text-white'));
        item.classList.add('bg-blue-200', 'text-white');
      });
    });

    const waktuItems = document.querySelectorAll('.urut-waktu');
    waktuItems.forEach(item => {
      item.addEventListener('click', (e) => {
        e.preventDefault();
        waktuItems.forEach(i => i.classList.remove('bg-blue-200', 'text-white'));
        item.classList.add('bg-blue-200', 'text-white');
      });
    });

    const kategoriRadios = document.querySelectorAll('.kategori-radio');
    kategoriRadios.forEach(radio => {
      radio.addEventListener('change', () => {
        kategoriRadios.forEach(r => {
          const label = r.closest('label');
          label.classList.remove('bg-blue-200', 'text-white');
        });
        const selected = document.querySelector('.kategori-radio:checked');
        if (selected) {
          const label = selected.closest('label');
          label.classList.add('bg-blue-200', 'text-white');
        }
      });
    });
  </script>
@endsection