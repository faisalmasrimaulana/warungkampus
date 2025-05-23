  @extends('layouts.app')

  @section('content')
  <!-- Tambahin stylesheet Swiper biar styling slider jalan -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8 pt-24">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Kolom Gambar -->
      <div class="md:col-span-1 bg-white rounded-xl shadow-md overflow-hidden flex items-center justify-center">
        @if($product->fotoproduk->isNotEmpty())
          <img src="{{ asset('storage/' . $product->fotoproduk->first()->path_fotoproduk) }}" alt="gambar produk" class="w-full h-auto object-cover">
        @else
          <img src="{{ asset('assets/sepatu.jpg') }}" alt="No Image" class="w-full h-auto object-cover" />
        @endif
      </div>

      <!-- Kolom Informasi -->
      <div class="md:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow-md p-6 flex flex-col justify-between h-full">
          <div class="flex justify-between items-start">
            <div>
              <h1 class="text-2xl font-bold text-gray-800 mb-1">{{ $product->nama_produk }}</h1>
              @if($product->kondisi != 'nocondition')
              <p class="text-sm text-gray-500 mb-3">{{$product->kategori}} - {{$product->kondisi}}</p>
              @else
              <p class="text-sm text-gray-500 mb-3">{{$product->kategori}}</p>
              @endif
            </div>
            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Tersedia</span>
          </div>

          <div class="mb-6">
            <p class="text-3xl font-bold text-blue-600">Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
            <p class="text-sm text-gray-500 mt-1">Harga sudah termasuk pajak</p>
          </div>

          <p class="text-gray-700 mb-6">
            {{ $product->deskripsi_singkat }}
          </p>

          <a href="https://wa.me/{{ $product->mahasiswa->whatsapp }}"
            class="whatsapp-button bg-blue-500 text-center text-white py-3 px-6 rounded-lg font-medium flex items-center justify-center space-x-2">
            <i data-feather="message-circle"></i>
            Hubungi Penjual via WhatsApp
          </a>
        </div>
      </div>
    </div>

    <!-- Kolom Tentang Penjual -->
    <div class="md:col-span-3 bg-white rounded-xl shadow-md p-6 mt-8 seller-card">
      <h3 class="font-semibold text-lg mb-4">Tentang Penjual</h3>
      <div class="flex items-center space-x-4">
        @if($product->mahasiswa && $product->mahasiswa->foto_profil != 'fotoprofil.jpg')
          <img src="{{ asset('storage/' . $product->mahasiswa->fotoprofil) }}" alt="Foto Penjual" class="w-12 h-12 rounded-full border-2 border-blue-100" />
        @else
          <img src="{{ asset('assets/fotoprofil.jpg') }}" alt="Penjual" class="w-12 h-12 rounded-full border-2 border-blue-100" />
        @endif

        <div>
          <h4 class="font-medium text-black">{{ $product->mahasiswa->nama }}</h4>
          <p class="text-sm text-gray-500">Mahasiswa Sistem Informasi</p>
        </div>
      </div>
      <div class="mt-4 pt-4 border-t border-gray-100">
        <div class="flex items-center text-sm text-gray-600 mb-2">
          <i data-feather="map-pin" class="w-4 h-4 mr-2"></i>
          <span>{{ $product->mahasiswa->alamat }}</span>
        </div>
        <div class="flex items-center text-sm text-gray-600">
          <i data-feather="clock" class="w-4 h-4 mr-2"></i>
          <span>Bergabung sejak {{ $product->mahasiswa->created_at->format('F Y') }}</span>
        </div>
      </div>
    </div>

    <!-- Foto Produk (Swiper Slider) -->
      <div class="md:col-span-3 bg-white rounded-xl shadow-md p-6 mt-8">
        @if($product->fotoproduk->isNotEmpty())
        <div class="flex items-center justify-center gap-4 ">
          @foreach($product->fotoproduk->take(5) as $index => $foto)
            <img 
              src="{{ asset('storage/' . $foto->path_fotoproduk) }}" 
              alt="gambar produk" 
              class="hover:border-blue-400 hover:border-2 object-cover w-36 aspect-square rounded-lg cursor-pointer border"
              onclick="openModal('{{ $index }}')"
            />
          @endforeach
        </div>
      </div>
        @endif
  
      <!-- Modal -->
      <div id="modal-wrapper" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden">
        <div id="modal-content" class="flex items-center justify-center w-full h-full">
          <div class="relative flex bg-white rounded-lg max-w-3xl w-full max-h-[80vh] p-8">
            <button onclick="closeModal()" class="absolute top-2 right-2 text-black text-3xl font-bold hover:text-red hover:cursor-pointer">&times;</button>
            <!-- Swiper -->
            <div class="swiper mySwiper w-full h-full">
              <div class="swiper-wrapper flex items-center">
                @foreach($product->fotoproduk as $foto)
                  <div class="swiper-slide h-full">
                    <img src="{{ asset('storage/' . $foto->path_fotoproduk) }}" alt="gambar produk" class="max-h-[70vh] object-contain rounded-lg flex w-full justify-center" />
                  </div>
                @endforeach
              </div>
              <div class="swiper-button-next text-black"></div>
              <div class="swiper-button-prev text-black"></div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- ./Modal -->
    <!-- ./Foto Produk -->

    <!-- Deskripsi Lengkap -->
    <div class="mt-8 bg-white rounded-xl shadow-md p-6">
      <h2 class="text-xl font-semibold text-gray-800 mb-4">Deskripsi Produk</h2>
      <div class="prose max-w-none text-gray-700">
        <p>
          {{ $product->deskripsi_lengkap }}
        </p>
      </div>
    </div>
  </div>

  <!-- Load Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    let swiper = null;

    function openModal(startIndex) {
      const wrapper = document.getElementById('modal-wrapper');
      wrapper.classList.remove('hidden');

      if (!swiper) {
        swiper = new Swiper('.mySwiper', {
          loop: true,
          initialSlide: startIndex,
          pagination: {
            el: '.swiper-pagination',
            clickable: true,
          },
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
        });
      } else {
        swiper.slideToLoop(startIndex, 0);
      }
    }

    function closeModal() {
      document.getElementById('modal-wrapper').classList.add('hidden');
    }

    document.getElementById('modal-wrapper').addEventListener('click', function (e) {
      if (e.target.id === 'modal-wrapper') {
        closeModal();
      }
    });

  </script>
  @endsection
