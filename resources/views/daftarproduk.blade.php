  @extends('layouts.app')

  @section('content')

    <div class="mt-[88px]"></div>

    <div id="overlay" class="fixed inset-0 bg-black opacity-50 hidden z-40"></div>

    <div class="flex items-center space-x-4 px-8 py-4 bg-blue-50">
        <x-button onclick="toggleSidebar()">
        Filter
        </x-button>
        <div class="relative flex-1">
          <form action="{{ route('produk.cari') }}" method="GET" class="relative">
              <x-input
                  type="text"
                  name="search"
                  value="{{ request('search') }}"
                  placeholder="Cari produk..."
                  class="w-full px-4 py-2 pr-10 bg-white"/>
              <svg xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5 text-gray-400 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35M11 17a6 6 0 100-12 6 6 0 000 12z"/>
              </svg>
          </form>

        </div>
    </div>
  @include('partials.sidebarfilter')
  <main class="p-6">

  @if($products-> count() > 0)
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
    @foreach($products as $prod)
      <a href="{{ route('produk.detail', ['id' => $prod->id]) }}">
        <div class="bg-white rounded-lg shadow-sm overflow-hidden transition-transform hover:scale-[1.02]">
          <img src="{{ asset('storage/' . ($prod->fotoproduk->first()->path_fotoproduk ?? 'default.jpg')) }}" alt="{{ $prod->nama_produk }}" class="w-full h-32 object-cover">
          <div class="p-3">
            <h3 class="text-sm font-semibold truncate">{{ $prod->nama_produk }}</h3>
            <p class="text-xs text-gray-500">{{ $prod-> created_at->format('D M Y') }}</p>
            @if($prod->kondisi != 'nocondition')
            <p class="text-xs text-gray-500">{{ $prod->kategori }} - {{$prod->kondisi}} </p><br>
            @else
            <p class="text-xs text-gray-500">{{ $prod->kategori }}</p><br>
            @endif
            <p class="text-sm text-blue-700 font-bold mt-1">Rp {{ number_format($prod->harga, 0, ',', '.') }}</p>
            <p class="text-xs text-gray-500">{{ $prod->deskripsi_singkat }}</p>
          </div>
        </div>
      </a>
    @endforeach
  @else
    @if(!empty($keyword))
    <p class="text-center text-gray-500 mt-4">Tidak ada produk yang cocok dengan kata kunci: <strong>{{ $keyword }}</strong> T-T</p>
    @else
    <p class="text-center text-gray-500 mt-4">Masukkan kata kunci untuk mencari produk 🔍</p>
    @endif
@endif
</div>
  </main>
@endsection