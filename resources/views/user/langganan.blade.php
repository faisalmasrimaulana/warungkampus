@include('partials.navbar')
<!-- Main Content -->
<!DOCTYPE html>
<html lang="id">
<head>
  @include('partials.head')
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8fafc;
    }
    .hero-gradient {
      background: linear-gradient(135deg, #f0f4ff 0%, #e6f0ff 100%);
    }
    .ad-card {
      transition: all 0.3s ease;
      border-radius: 12px;
      overflow: hidden;
      position: relative;
    }
    .ad-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    .popular-tag {
      position: absolute;
      top: 15px;
      right: -30px;
      background-color: #3b82f6;
      color: white;
      padding: 3px 30px;
      transform: rotate(45deg);
      font-size: 12px;
      font-weight: 600;
    }
    .feature-badge {
      background-color: #e0e7ff;
      color: #3b82f6;
      border-radius: 20px;
      padding: 2px 10px;
      font-size: 12px;
      font-weight: 500;
    }
  </style>
</head>
<body>

<!-- Main Content -->
<main class="hero-gradient min-h-screen py-12 px-4 mt-10 sm:px-6 lg:px-8">
  <div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="text-center mb-12">
      <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
        <span class="text-blue-500">Promosikan Produkmu</span> di WarungKampus
      </h1>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        Tingkatkan penjualan dengan mempromosikan produk Anda ke ribuan mahasiswa
      </p>
    </div>


    <!-- Advertising Packages -->
    <div class="grid md:grid-cols-3 gap-6 mb-12">
      <!-- Basic Package -->
      <div class="ad-card bg-white border border-gray-200">
        <div class="p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-2">Gratis</h3>
          <p class="text-gray-600 text-sm mb-4">Versi kamu saat ini</p>
          <div class="mb-4">
            <span class="text-3xl font-bold text-gray-800">Rp0,00</span>
            
          </div>
          <button class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-2 rounded-lg transition">
            Pilihan saat ini
          </button>
        </div>
        <div class="border-t border-gray-200 p-6">
          <ul class="space-y-3">
            <li class="flex items-start">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
              </svg>
              <span>Tampil di halaman pencarian</span>
            </li>
            <li class="flex items-start">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm2.121-11.121a1 1 0 00-1.414 0L10 7.586 9.293 6.879a1 1 0 10-1.414 1.414L8.586 9l-.707.707a1 1 0 101.414 1.414L10 10.414l.707.707a1 1 0 001.414-1.414L11.414 9l.707-.707a1 1 0 000-1.414z" clip-rule="evenodd" />
            </svg>
            <span>Tidak ada badge</span>
          </li>
          </ul>
        </div>
      </div>

      <!-- Popular Package -->
      <div class="ad-card bg-white border-2 border-blue-500 relative">
        <div class="popular-tag">TERPOPULER</div>
        <div class="p-6">
          <div class="flex justify-between items-start">
            <div>
              <h3 class="text-xl font-bold text-gray-800 mb-2">Premium Mingguan</h3>
              <p class="text-gray-600 text-sm mb-4">Promosikan produk kamu tiap minggunya</p>
            </div>
            <span class="feature-badge">Best Seller</span>
          </div>
          <div class="mb-4">
            <span class="text-3xl font-bold text-gray-800">Rp35.000</span>
            <span class="text-gray-500">/2 minggu</span>
          </div>
          <button class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 rounded-lg transition">
            Pilih Paket
          </button>
        </div>
        <div class="border-t border-gray-200 p-6">
          <ul class="space-y-3">
            <li class="flex items-start">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
              </svg>
              <span><strong>Tampil di banner utama</strong></span>
            </li>
            <li class="flex items-start">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
              </svg>
              <span>Posisi atas hasil pencarian</span>
            </li>
             <li class="flex items-start">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
              </svg>
              <span>Badge "Rekomendasi"</span>
            </li>
          </ul>
        </div>
      </div>

      <!-- Premium Package -->
      <div class="ad-card bg-white border border-gray-200">
        <div class="p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-2">Premium Bulanan</h3>
          <p class="text-gray-600 text-sm mb-4">Jangkau lebih banyak dengan waktu lebih lama</p>
          <div class="mb-4">
            <span class="text-3xl font-bold text-gray-800">Rp65.000</span>
            <span class="text-gray-500">/1 bulan</span>
          </div>
          <button class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-2 rounded-lg transition">
            Pilih Paket
          </button>
        </div>
        <div class="border-t border-gray-200 p-6">
          <ul class="space-y-3">
            <li class="flex items-start">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
              </svg>
              <span><strong>Tampil di banner utama</strong></span>
            </li>
            <li class="flex items-start">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
              </svg>
              <span>Posisi atas hasil pencarian</span>
            </li>
            <li class="flex items-start">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
              </svg>
              <span>Badge "Rekomendasi Eksklusif"</span>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <!-- How It Works -->
    <div class="bg-white rounded-xl p-8 mb-12 shadow-sm">
      <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Cara Kerja Promosi Produk</h2>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="text-center">
          <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-2xl font-bold text-blue-600">1</span>
          </div>
          <h3 class="font-semibold text-lg mb-2">Pilih Paket</h3>
          <p class="text-gray-600">Tentukan paket promosi dan durasi yang diinginkan</p>
        </div>
        <div class="text-center">
          <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-2xl font-bold text-blue-600">2</span>
          </div>
          <h3 class="font-semibold text-lg mb-2">Pilih Produk</h3>
          <p class="text-gray-600">Pilih produk yang ingin dipromosikan dari daftar produk Anda</p>
        </div>
        <div class="text-center">
          <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-2xl font-bold text-blue-600">3</span>
          </div>
          <h3 class="font-semibold text-lg mb-2">Lakukan Pembayaran</h3>
          <p class="text-gray-600">Selesaikan pembayaran dan produk Anda akan langsung dipromosikan</p>
        </div>
      </div>
    </div>

    <!-- Testimonials -->
    <div class="mb-12">
      <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Apa Kata Pengguna?</h2>
      <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-blue-50 p-6 rounded-xl">
          <div class="flex items-center mb-4">
            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="User" class="w-12 h-12 rounded-full mr-4">
            <div>
              <h4 class="font-semibold">Dina Rahmawati</h4>
              <p class="text-sm text-gray-600">Mahasiswa Bisnis</p>
            </div>
          </div>
          <p class="text-gray-700">"Setelah pakai paket Sorotan Utama, produk jualan saya laku 3x lebih banyak! Worth it banget buat mahasiswa yang jualan sampingan kayak saya."</p>
        </div>
        <div class="bg-green-50 p-6 rounded-xl">
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
</main>

<script>

  document.addEventListener('DOMContentLoaded', () => {
    
    // Duration selector functionality
    const durationButtons = document.querySelectorAll('.inline-flex button');
    durationButtons.forEach(button => {
      button.addEventListener('click', () => {
        durationButtons.forEach(btn => {
          btn.classList.remove('bg-blue-50', 'text-blue-600', 'font-semibold');
          btn.classList.add('bg-white', 'text-gray-700');
        });
        button.classList.add('bg-blue-50', 'text-blue-600', 'font-semibold');
        button.classList.remove('bg-white', 'text-gray-700');
        
        // Update prices based on duration (could be implemented)
      });
    });
  });
</script>

</body>
</html>

</body>
</html>