@extends('layouts.app')
@section('content')

  <style>
      .carousel {
      position: relative;
      overflow: hidden;
    }
    .carousel-inner {
      display: flex;
      transition: transform 0.5s ease;
    }
    .carousel-item {
      min-width: 100%;
      box-sizing: border-box;
    }
    .carousel-control {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background-color: rgba(255, 255, 255, 0.5);
      border: none;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      z-index: 5 ;
    }
    .carousel-control.prev {
      left: 10px;
    }
    .carousel-control.next {
      right: 10px;
    }
    .carousel-indicators {
      position: absolute;
      bottom: 10px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      gap: 5px;
    }
    .carousel-indicator {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background-color: rgba(255, 255, 255, 0.5);
      cursor: pointer;
    }
    .carousel-indicator.active {
      background-color: white;
    }
    .promo-banner {
      background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
      border-radius: 12px;
      overflow: hidden;
      position: relative;
      height: 150px;
    }
    .promo-content {
      position: relative;
      z-index: 2;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 20px;
    }
    .promo-banner::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,224L48,218.7C96,213,192,203,288,181.3C384,160,480,128,576,138.7C672,149,768,203,864,213.3C960,224,1056,192,1152,165.3C1248,139,1344,117,1392,106.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
      background-size: cover;
      background-position: bottom;
      opacity: 0.2;
    }
    .pulse {
      animation: pulse 2s infinite;
    }
    @keyframes pulse {
      0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(124, 58, 237, 0.7); }
      70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(124, 58, 237, 0); }
      100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(124, 58, 237, 0); }
    }

  </style>

  <div id="overlay" class="fixed inset-0 bg-black/50 hidden z-40"></div>
  <div class="flex items-center space-x-4 px-8 py-4 mt-20 bg-blue-50">
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
    <!-- Banner Promosi -->
  <!-- Banner Carousel -->
  <div class="px-4 py-6">
    <div class="carousel mx-auto max-w-5xl relative">
      <div class="carousel-inner">
        <!-- Slide 1 -->
        <div class="carousel-item">
          <a href="{{route('user.langganan')}}">
            <div class="promo-banner cursor-pointer">
              <div class="promo-content text-center">
                <h2 class="text-xl md:text-2xl font-bold text-white mb-2">Ingin produkmu dijangkau lebih banyak orang?</h2>
                <p class="text-lg md:text-xl font-semibold text-yellow-300">Ayo klik di sini!</p>
              </div>
            </div>
          </a>
        </div>
        
        <!-- Slide 2 -->
        <div class="carousel-item">
          <a href="{{route('user.langganan')}}">
            <div class="promo-banner cursor-pointer" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);">
              <div class="promo-content text-center">
                <h2 class="text-xl md:text-2xl font-bold text-white mb-2">Tingkatkan penjualan produkmu!</h2>
                <p class="text-lg md:text-xl font-semibold text-yellow-300">Promosikan di sini</p>
              </div>
            </div>
          </a>
        </div>
        
        <!-- Slide 3 -->
        <div class="carousel-item">
          <a href="{{route('user.langganan')}}">
            <div class="promo-banner cursor-pointer" style="background: linear-gradient(135deg, #10b981 0%, #047857 100%);">
              <div class="promo-content text-center">
                <h2 class="text-xl md:text-2xl font-bold text-white mb-2">Jangkau ribuan mahasiswa!</h2>
                <p class="text-lg md:text-xl font-semibold text-yellow-300">Iklankan produkmu sekarang</p>
              </div>
            </div>
          </a>
        </div>
      </div>
      
      <button class="carousel-control prev" onclick="prevSlide()">❮</button>
      <button class="carousel-control next" onclick="nextSlide()">❯</button>
      
      <div class="carousel-indicators">
        <div class="carousel-indicator active" onclick="goToSlide(0)"></div>
        <div class="carousel-indicator" onclick="goToSlide(1)"></div>
        <div class="carousel-indicator" onclick="goToSlide(2)"></div>
      </div>
    </div>
  </div>
  <main class="p-6">


    @if($products->count() > 0)
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
    
      @foreach($products as $prod)
      @if(!$prod->is_sold)
      <x-cardproduct :prod="$prod"></x-cardproduct>
      @endif
      @endforeach
      <div class="mt-2">{{ $products->appends(request()->except('page'))->links() }}</div>
    @elseif($products->count()==0)
      <div class="flex w-full items-center justify-center"><h1 class="font-bold text-xl">Belum ada produk yang diunggah</h1></div>
      @else
        @if(!empty($keyword))
        <p class="text-center text-gray-500 mt-4">Tidak ada produk yang cocok dengan kata kunci: <strong>{{ $keyword }}</strong> T-T</p>
        @else
        <p class="text-center text-gray-500 mt-4">Masukkan kata kunci untuk mencari produk 🔍</p>
        @endif
      @endif
    </div>
  </main>

  <script>
            // Carousel functionality
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-item');
    const indicators = document.querySelectorAll('.carousel-indicator');
    const carouselInner = document.querySelector('.carousel-inner');
    
    function updateCarousel() {
      carouselInner.style.transform = `translateX(-${currentSlide * 100}%)`;
      
      // Update indicators
      indicators.forEach((indicator, index) => {
        indicator.classList.toggle('active', index === currentSlide);
      });
    }
    
    function nextSlide() {
      currentSlide = (currentSlide + 1) % slides.length;
      updateCarousel();
    }
    
    function prevSlide() {
      currentSlide = (currentSlide - 1 + slides.length) % slides.length;
      updateCarousel();
    }
    
    function goToSlide(index) {
      currentSlide = index;
      updateCarousel();
    }
    
    // Auto-advance slides every 5 seconds
    setInterval(nextSlide, 5000);
    
    // Touch support for mobile
    let touchStartX = 0;
    let touchEndX = 0;
    
    const carousel = document.querySelector('.carousel');
    carousel.addEventListener('touchstart', (e) => {
      touchStartX = e.changedTouches[0].screenX;
    }, {passive: true});
    
    carousel.addEventListener('touchend', (e) => {
      touchEndX = e.changedTouches[0].screenX;
      handleSwipe();
    }, {passive: true});
    
    function handleSwipe() {
      const difference = touchStartX - touchEndX;
      if (difference > 50) {
        nextSlide(); // Swipe left
      } else if (difference < -50) {
        prevSlide(); // Swipe right
      }
    }
  </script>
@endsection