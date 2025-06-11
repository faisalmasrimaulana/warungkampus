
<!-- Main Content -->>
<head>
  @include('partials.head')
  <style>
    .package-card {
      transition: all 0.3s ease;
      border: 2px solid transparent;
    }
    .package-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    .package-card.selected {
      border-color: #3b82f6;
      background-color: #f0f7ff;
    }
    .product-checkbox:checked + .product-card {
      border-color: #3b82f6;
      background-color: #f0f7ff;
    }
  </style>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>

<!-- Main Content -->
@include('partials.navbar')
<main class=" min-h-screen py-12 px-4 mt-10 sm:px-6 lg:px-8">
  <div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="text-center mb-12">
      <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
        <span class="text-blue-500">Promosikan</span> Produkmu di <x-logo></x-logo>
      </h1>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        Tingkatkan penjualan dengan mempromosikan produk Anda ke lebih banyak orang!
      </p>
    </div>

    <div class="grid md:grid-cols-3 gap-6 mb-12">
      <!-- Basic Package -->
      <div id="basicPackage" class="bg-white rounded-xl p-6 shadow-md cursor-pointer">
        <div class="flex flex-col h-full justify-between">
          <div class="flex flex-col">
            <div class="flex justify-between mb-4">
              <div>
                <h2 class="text-xl font-bold text-blue-600">Paket Basic</h2>
                <p class="text-gray-500">Tanpa promosi</p>
              </div>
              <div>
                <p class="bg-blue-100 text-blue-800 px-3 py-1 rounded-lg text-sm font-medium">Rp 0</p>
              </div>
              </div>
              <div>
                <ul class="mb-6 text-gray-700">
                  <li class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Tampil di halaman produk
                  </li>
                </ul>
              </div>  
          </div>
          <div class="flex">
            @if($subscriptionStatus == 'tidak_langganan')
              <x-button class="w-full justify-center">
                Paket Saat ini
              </x-button>
            @else
              <x-button class="w-full justify-center" color="disable">
                Tidak dipakai
              </x-button>
            @endif
          </div>
        </div>
      </div>


      <!-- Weekly Package -->
        <div id="weeklyPackage" class="package-card bg-white rounded-xl p-6 shadow-md cursor-pointer selected">
          <div class="flex flex-col h-full justify-between">
            <div class="flex flex-col">
              <div class="flex justify-between mb-4">
                <div>
                  <h2 class="text-xl font-bold text-blue-600">Paket Mingguan</h2>
                  <p class="text-gray-500">Promosi 1 produk</p>
                </div>
                <div>
                  <p class="bg-blue-100 text-blue-800 px-3 py-1 rounded-lg text-sm font-medium">Rp 50.000</p>
                </div>
              </div>
              <div>
                <ul class="text-gray-700">
                  <li class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Promosi selama 7 hari
                  </li>
                  <li class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Tampil di bagian rekomendasi produk
                  </li>
                  <li class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Peningkatan traffic hingga 3x lipat
                  </li>
                </ul>
              </div>
            </div>
            <div class="flex">
              @if($subscriptionStatus == 'mingguan')
                <x-button class="w-full justify-center" color="disable">
                  Paket Saat Ini
                </x-button>
              @else
                <x-button onclick="openWeeklyModal()" class="w-full justify-center">
                  Pilih Paket
                </x-button>
              @endif
            </div>
          </div>
        </div>

      <!-- Monthly Package -->
        <div id="monthlyPackage" class="package-card bg-white rounded-xl p-6 shadow-md cursor-pointer">
          <div class="flex flex-col h-full justify-between">
            <div class="flex flex-col">
              <div class="flex justify-between mb-4">
                <div>
                    <h2 class="text-xl font-bold text-blue-600">Paket Bulanan</h2>
                    <p class="text-gray-500">Promosi 2 produk</p>
                </div>
                <div>
                    <p class="bg-blue-100 text-blue-800 px-3 py-1 rounded-lg text-sm font-medium">Rp 150.000</p>
                </div>
              </div>
              <div class="mb-4">
                <ul class="text-gray-700">
                  <li class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Promosi selama 1 bulan
                  </li>
                  <li class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>Tampil di banner utama
                  </li>
                  <li class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Tampil di bagian promosi   produk
                  </li>
                  <li class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>Peningkatan traffic hingga 10x lipat
                  </li>
                </ul>
              </div>
            </div>
            <div class="flex">
              @if($subscriptionStatus == 'bulanan')
                <x-button class="w-full justify-center" color="disable">
                  Paket Saat Ini
                </x-button>
              @else
                <x-button onclick="openMonthlyModal()" class="w-full justify-center">
                  Pilih Paket
                </x-button>
              @endif
            </div>
          </div>
        </div>
    </div>

    <!-- How It Works -->
    <div class="bg-white rounded-xl p-6 shadow-md mb-12">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Cara Kerja Promosi</h2>
        <div class="grid md:grid-cols-3 gap-4">
          <div class="text-center p-4">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
              <span class="text-blue-600 font-bold">1</span>
            </div>
            <h3 class="font-semibold mb-2">Pilih Paket</h3>
            <p class="text-sm text-gray-600">Pilih antara paket mingguan atau bulanan sesuai kebutuhan Anda</p>
          </div>
          <div class="text-center p-4">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
              <span class="text-blue-600 font-bold">2</span>
            </div>
            <h3 class="font-semibold mb-2">Pilih Produk</h3>
            <p class="text-sm text-gray-600">Pilih produk yang ingin dipromosikan (1 untuk mingguan, 2 untuk bulanan)</p>
          </div>
          <div class="text-center p-4">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
              <span class="text-blue-600 font-bold">3</span>
            </div>
            <h3 class="font-semibold mb-2">Bayar & Aktif</h3>
            <p class="text-sm text-gray-600">Lakukan pembayaran dan promosi akan langsung aktif</p>
          </div>
        </div>
      </div>

    <!-- Testimonials -->
    <div class="mb-12">
      <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Apa Kata Pengguna?</h2>
      <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-blue-200 p-6 rounded-xl">
          <div class="flex items-center mb-4">
            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="User" class="w-12 h-12 rounded-full mr-4">
            <div>
              <h4 class="font-semibold">Dina Rahmawati</h4>
              <p class="text-sm text-gray-600">Mahasiswa Bisnis</p>
            </div>
          </div>
          <p class="text-gray-700">"Setelah pakai paket Sorotan Utama, produk jualan saya laku 3x lebih banyak! Worth it banget buat mahasiswa yang jualan sampingan kayak saya."</p>
        </div>
        <div class="bg-green-200 p-6 rounded-xl">
          <div class="flex items-center mb-4">
            <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="User" class="w-12 h-12 rounded-full mr-4">
            <div>
              <h4 class="font-semibold">Rizky Pratama</h4>
              <p class="text-sm text-gray-600">UKM Kampus</p>
            </div>
          </div>
          <p class="text-gray-700">"Paket Eksklusif sangat membantu promosi kaos organisasi kami. Dalam 1 minggu sudah dapat 50+ pesanan dari berbagai fakultas."</p>
        </div>
      </div>
    </div>

    <!-- Final CTA -->
    <div class="text-center">
      <p class="text-gray-600 mb-6 max-w-2xl mx-auto">Mulai promosikan produk Anda sekarang dan jangkau lebih banyak pembeli di WarungKampus</p>
    </div>
  </div>

  <!-- Weekly Package Modal -->
  <div id="weeklyModal" class="fixed inset-0 bg-black/50 items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto">
      <div class="p-6"> 
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-bold text-blue-600">Paket Mingguan</h2>
          <button onclick="closeModal('weeklyModal')" class="text-gray-500 hover:text-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>

        <form>
          @csrf
          <div class="mb-6">
            <h3 class="font-medium mb-2">Pilih 1 Produk untuk Dipromosikan</h3>
            <div class="space-y-3">
              @forelse($products as $prod)
              <label class="block">
                <input type="checkbox" class="product-checkbox hidden" name="weeklyProduct" value="{{$prod->id}}">
                <div class="product-card border rounded-lg p-3 hover:border-blue-400 cursor-pointer">
                  <div class="flex items-center">
                    <img src="{{asset('storage/' . ($prod->fotoproduk->first()->path_fotoproduk))}}" alt="{{$prod->nama_produk}}" class="w-12 h-12 object-cover rounded mr-3">
                    <div>
                      <h4 class="font-medium">{{$prod->nama_produk}}</h4>
                      <p class="text-sm text-gray-500">{{$prod->harga_format}}</p>
                    </div>
                  </div>
                </div>
              </label>
              @empty
             <p>Belum ada produk</p> 
              @endforelse
            </div>
          </div>
          
          <div class="bg-blue-50 p-4 rounded-lg mb-6">
            <h3 class="font-medium mb-2">Ringkasan Pembayaran</h3>
            <div class="flex justify-between mb-1">
              <span>Paket Mingguan</span>
              <span>Rp 50.000</span>
            </div>
            <div class="flex justify-between font-bold">
              <span>Total</span>
              <span>Rp 50.000</span>
            </div>
          </div>
          
          <x-button onclick="processWeeklyPayment()" class="w-full flex justify-center">
            Lanjutkan Pembayaran
          </x-button>
        </form>
        </div>
    </div>
  </div>

  <!-- Monthly Package Modal -->
  <div id="monthlyModal" class="fixed inset-0 bg-black/50 items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto">
      <div class="p-6">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-bold text-blue-600">Paket Bulanan</h2>
          <button onclick="closeModal('monthlyModal')" class="text-gray-500 hover:text-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>
        <form>
          @csrf
          <div class="mb-6">
            <h3 class="font-medium mb-2">Pilih 2 Produk untuk Dipromosikan</h3>
            <div class="space-y-3">
              @forelse($products as $prod)
              <label class="block">
                <input type="checkbox" class="product-checkbox hidden" name="monthlyProduct" value="{{$prod->id}}">
                <div class="product-card border rounded-lg p-3 hover:border-blue-400 cursor-pointer">
                  <div class="flex items-center">
                    <img src="{{asset('storage/' . ($prod->fotoproduk->first()->path_fotoproduk))}}" alt="{{$prod->nama_produk}}" class="w-12 h-12 object-cover rounded mr-3">
                    <div>
                      <h4 class="font-medium">{{$prod->nama_produk}}</h4>
                      <p class="text-sm text-gray-500">{{$prod->harga_format}}</p>
                    </div>
                  </div>
                </div>
              </label>
              @empty
              <p>Belum ada produk</p>
              @endforelse
            </div>
          </div>
          
          <div class="mb-6">
            <h3 class="font-medium mb-2">Buat Kalimat Promosi Toko</h3>
            <textarea id="promoMessage" name="promo_message" class="w-full border rounded-lg p-3 focus:border-blue-400 focus:ring-blue-400" rows="3" placeholder="Contoh: 'Diskon 20% untuk semua produk selama bulan ini!'"></textarea>
            <p class="text-sm text-gray-500 mt-1">Kalimat ini akan muncul di banner promosi toko Anda</p>
          </div>
          
          <div class="bg-blue-50 p-4 rounded-lg mb-6">
            <h3 class="font-medium mb-2">Ringkasan Pembayaran</h3>
            <div class="flex justify-between mb-1">
              <span>Paket Bulanan</span>
              <span>Rp 150.000</span>
            </div>
            <div class="flex justify-between font-bold">
              <span>Total</span>
              <span>Rp 150.000</span>
            </div>
          </div>
          
          <x-button onclick="processMonthlyPayment()" class="w-full flex justify-center">
            Lanjutkan Pembayaran
          </x-button>
        </form>
      </div>
    </div>
  </div>
</main>

<script>
  // Package Selection

  const weeklyPackage = document.getElementById('weeklyPackage');
  const monthlyPackage = document.getElementById('monthlyPackage');

  weeklyPackage.addEventListener('click', () => {
    weeklyPackage.classList.add('selected');
    monthlyPackage.classList.remove('selected');
  });

  monthlyPackage.addEventListener('click', () => {
    monthlyPackage.classList.add('selected');
    weeklyPackage.classList.remove('selected');
  });

  // Modal Functions
  function openWeeklyModal() {
    document.getElementById('weeklyModal').classList.remove('hidden');
    document.getElementById('weeklyModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
    
  }

  function openMonthlyModal() {
    document.getElementById('monthlyModal').classList.remove('hidden');
     document.getElementById('monthlyModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
  }

  function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.getElementById(modalId).classList.remove('flex');
    document.body.style.overflow = 'auto';
  }

  // Product Selection
  document.querySelectorAll('.product-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
      // For weekly package - single selection
      if (this.name === 'weeklyProduct') {
        if (this.checked) {
          document.querySelectorAll('input[name="weeklyProduct"]').forEach(cb => {
            if (cb !== this) cb.checked = false;
          });
          document.querySelectorAll('.product-card').forEach(card => {
            card.classList.remove('border-blue-400', 'bg-blue-50');
          });
        }
        this.closest('label').querySelector('.product-card').classList.toggle('border-blue-400', this.checked);
        this.closest('label').querySelector('.product-card').classList.toggle('bg-blue-50', this.checked);
      }
      
      // For monthly package - max 2 selections
      if (this.name === 'monthlyProduct') {
        const checkedBoxes = document.querySelectorAll('input[name="monthlyProduct"]:checked');
        if (checkedBoxes.length > 2) {
          this.checked = false;
          return;
        }
        this.closest('label').querySelector('.product-card').classList.toggle('border-blue-400', this.checked);
        this.closest('label').querySelector('.product-card').classList.toggle('bg-blue-50', this.checked);
      }
    });
  });

  // Payment Processing
  function processWeeklyPayment() {
      const selectedProduct = document.querySelector('input[name="weeklyProduct"]:checked');
      if (!selectedProduct) {
        alert('Silakan pilih 1 produk untuk dipromosikan');
        return;
      }

      const productId = selectedProduct.value;

      fetch('/weekly-subscription-process', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
        },
        body: JSON.stringify({
          product_id: selectedProduct.value
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.snapToken) {
          snap.pay(data.snapToken, {
            onSuccess: function(result) {
              window.location.href = `/weeklysub/success?order_id=${result.order_id}`;
            },
            onPending: function(result) {
               console.log("Menunggu pembayaran:", result);
            },
            onError: function(result) {
              alert('Pembayaran gagal. Coba lagi nanti.');
            }
          });
        } else {
          alert('Gagal mendapatkan token pembayaran');
        }
      })
      .catch(err => {
        console.error(err);
        alert('Terjadi kesalahan saat memproses pembayaran.');
      });
  }


  function processMonthlyPayment() {
    const checkboxes = document.querySelectorAll('input[name="monthlyProduct"]:checked');
    if (checkboxes.length !== 2) {
      alert("Pilih 2 produk untuk dipromosikan yaa!");
      return;
    }

    const selectedProducts = [...checkboxes].map(cb => cb.value);
    const promoMessage = document.getElementById('promoMessage').value;

    fetch('/monthly-subscription-process', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
        },
        body: JSON.stringify({
          product_1_id: selectedProducts[0],
          product_2_id: selectedProducts[1],
          promo_message: promoMessage
        })
      }).then(res => res.json())
        .then(data => {
          if (data.snapToken) {
            snap.pay(data.snapToken, {
              onSuccess: function(result) {
                window.location.href = `/monthlysub/success?order_id=${result.order_id}`;
              },
              onPending: function(result) {
                alert("Pembayaran masih pending");
              },
              onError: function(result) {
                alert("Pembayaran gagal...");
              }
            });
          } else {
            alert("Gagal memproses transaksi");
          }
        }).catch(err => {
        console.error(err);
        alert('Terjadi kesalahan saat memproses pembayaran.');
      });
      }
</script>

</body>