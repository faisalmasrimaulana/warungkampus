  @extends('layouts.app')

  @section('content')
  <!-- Swiper Link -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

  <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8 pt-24">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Kolom Gambar -->
      <div class="md:col-span-1 bg-white rounded-xl shadow-md overflow-hidden flex items-center justify-center">
        @if($product->fotoproduk->isNotEmpty())
          <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="gambar produk" class="w-full h-64 object-cover">
        @else
          <img src="{{ asset('assets/sepatu.jpg') }}" alt="No Image" class="w-full h-80 object-cover" />
        @endif
      </div>

      <!-- Kolom Informasi -->
      <div class="md:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow-md p-6 flex flex-col justify-between h-full">
          <div class="flex justify-between items-start">
            <div>
              <h1 class="text-2xl font-bold text-gray-800 mb-1">{{ $product->nama_produk }}</h1>
              <p class="text-sm text-gray-500 mb-3">
                {{ $product->kategori }}{{ $product->kondisi != 'nocondition' ? ' - ' . $product->kondisi : '' }}
              </p>
            </div>
            <x-badge :status="$product->is_sold ? 'sold' : 'available'" />
          </div>

          <div class="mb-6">
            <p class="text-3xl font-bold text-blue-600">{{$product->harga_format}}</p>
            <p class="text-sm text-gray-500 mt-1">Harga sudah termasuk pajak</p>
          </div>

          <p class="text-gray-700 mb-6">
            {{ $product->deskripsi_singkat }}
          </p>

          <div class="grid grid-cols-2 space-x-2">
            <div class="grid">
              <x-button class="checkout-button flex justify-center" color="primary"> Beli</x-button>
            </div>
            <div class="">
              <x-button href="https://wa.me/{{ $product->mahasiswa->whatsapp }}" class="gap-2 flex items-center justify-center" color="secondary">
                <i class="fa-brands fa-lg fa-whatsapp"></i>
                Hubungi Penjual via WhatsApp</x-button>
            </div>
          </div>
      </div>
    </div>

    <!-- Kolom Tentang Penjual -->
    <div class="md:col-span-3 bg-white rounded-xl shadow-md p-6 seller-card">
      <h3 class="font-semibold text-lg mb-4">Tentang Penjual</h3>
      <a href="{{Auth::check() && Auth::id() === $product->mahasiswa->id ? route('user.dashboard') :  route('user.publicprofile', ['user'=>$product->mahasiswa->id])}}">
        <div class="flex items-center space-x-4">
          @if($product->mahasiswa && $product->mahasiswa->foto_profil != 'fotoprofil.jpg')
            <img src="{{$product->mahasiswa->foto_profil!= 'fotoprofil.jpg' ? asset('storage/' . $product->mahasiswa->foto_profil) : asset('assets/fotoprofil.jpg')}}" alt="Foto Penjual" class="w-12 h-12 rounded-full border-2 border-blue-100" />
          @else
            <img src="{{ asset('assets/fotoprofil.jpg') }}" alt="Penjual" class="w-12 h-12 rounded-full border-2 border-blue-100" />
          @endif
  
          <div>
            <h4 class="font-medium text-black">{{ $product->mahasiswa->nama }}</h4>
            <p class="text-sm text-gray-500">Mahasiswa Sistem Informasi</p>
          </div>
        </div>
      </a>
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
      <div class="md:col-span-3 bg-white rounded-xl shadow-md p-6">
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
    <div class="md:col-span-3 bg-white rounded-xl shadow-md p-6">
      <h2 class="text-xl font-semibold text-gray-800 mb-4">Deskripsi Produk</h2>
      <div class="prose max-w-none text-gray-700">
        <p>
          {{ $product->deskripsi_lengkap }}
        </p>
      </div>
    </div>
  </div>

  <!-- Modal Checkout -->
  <!-- Modal Checkout -->
<div id="checkoutModal" class="fixed inset-0 bg-black/50 hidden z-50 items-center justify-center">
  <form id="checkoutForm" class="bg-white rounded-lg p-6 space-y-4 w-96">
      <h1 class="text-black font-semibold text-center capitalize">Informasi Pelanggan</h1>
      @csrf
      <input type="hidden" name="product_id" value="{{ $product->id }}"/>
      <x-input name="nama_pembeli" placeholder="Nama Pembeli" />
      <p class="text-red-500 text-sm mt-1 error-message" data-field="nama_pembeli"></p>
      <x-input name="email_pembeli" placeholder="Email" />
      <p class="text-red-500 text-sm mt-1 error-message" data-field="email_pembeli"></p>
      <x-input name="no_hp_pembeli" placeholder="No HP" />
      <p class="text-red-500 text-sm mt-1 error-message" data-field="no_hp_pembeli"></p>
      <x-input name="alamat_pembeli" placeholder="Alamat" />
      <p class="text-red-500 text-sm mt-1 error-message" data-field="alamat_pembeli"></p>
      <x-input name="catatan" placeholder="Catatan untuk penjual (opsional)" />
      <p class="text-red-500 text-sm mt-1 error-message" data-field="catatan"></p>
      <input type="number" name="harga" value="{{ $product->harga }}" hidden>
      <div class="flex justify-between">
        <x-button size="md" type="button" id="pay-button" color="primary">Bayar Sekarang</x-button>
        <x-button size="md" type="button" id="close-button" color="danger">Batalkan</x-button>
      </div>
  </form>
</div>

    <!-- ./Modal -->

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
  
  <!-- Checkout modal -->
  <script>
      document.querySelector('.checkout-button').addEventListener('click', function(e) {
    e.preventDefault(); // Cegah halaman reload
    document.getElementById('checkoutModal').classList.remove('hidden');
    document.getElementById('checkoutModal').classList.add('flex');
    });
    document.getElementById('close-button').addEventListener('click', function(e){
      e.preventDefault();
      document.getElementById('checkoutModal').classList.remove('flex');
      document.getElementById('checkoutModal').classList.add('hidden');
    })
  </script>

  <script>
    document.getElementById('pay-button').addEventListener('click', function () {
      const form = document.getElementById('checkoutForm');
      const formData = new FormData(form);

      // Reset error messages dulu
      document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

      fetch("{{ route('payment.process') }}", {
        method: "POST",
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
      })
      .then(async response => {
        if (!response.ok) {
          const errorData = await response.json();
          if (errorData.errors) {
            for (const field in errorData.errors) {
              const errorEl = document.querySelector(`.error-message[data-field="${field}"]`);
              if (errorEl) {
                errorEl.textContent = errorData.errors[field][0];
              }
            }
          }
          throw new Error("Validasi gagal");
        }

        return response.json();
      })
      .then(data => {
        window.snap.pay(data.snapToken, {
          onSuccess: function(result){
            console.log("Pembayaran sukses:", result);
            window.location.href = `/payment/success?order_id=${result.order_id}`;
          },
          onPending: function(result){
            console.log("Menunggu pembayaran:", result);
          },
          onError: function(result){
            console.error("Pembayaran error:", result);
          },
          onClose: function(){
            alert("Kamu menutup pop-up sebelum selesai 😢");
          }
        });
      })
      .catch(err => {
        console.error("Terjadi error saat fetch:", err);
      });
    });
  </script>
  
  @endsection
