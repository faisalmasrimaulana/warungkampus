<!-- DASHBOARD GUESS / HOME -->
@extends('layouts.app')

@section('content')
<div class="hero-gradient min-h-screen py-16 px-4 sm:px-6 lg:px-8">
  <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8 pt-24">
    <!-- Hero Section -->
    <section class="text-center mb-20">
      <div class="inline-block bg-gradient-to-r from-blue-400 to-blue-600 text-white px-4 py-2 rounded-full text-sm mb-6 shadow-lg">
        ✨ MarketPlace Mahasiswa Pertama di Jambi ✨
      </div>
      <h1 class="text-4xl md:text-6xl font-bold text-[#1f2d4e] mb-6 leading-tight glow-text">
        Sesama <span class="text-blue-500"> Mahasiswa </span> Bantu <br> Barang <span class="text-green-500"> Jasa </span> Laku
      </h1>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-12">
        Marketplace khusus mahasiswa untuk jual beli barang bekas dan jasa. 
        Praktis, hemat, dan saling bantu antar sesama mahasiswa.
      </p>
    </section>
    
    <!-- Features Section -->
    <section class="grid md:grid-cols-3 gap-8 mb-20">
      <div class="feature-card p-8 rounded-2xl">
        <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-5">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-3 text-gray-800">Mulai Jualan</h3>
        <p class="text-gray-600">Tawarkan pada mahasiswa lain barang bekas atau jasa yang masih layak.</p>
      </div>
      
      <div class="feature-card p-8 rounded-2xl">
        <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mb-5">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-3 text-gray-800">Temukan Produk</h3>
        <p class="text-gray-600">Jelajahi berbagai produk yang bermanfaat untuk menunjang perkuliahanmu.</p>
      </div>
      
      <div class="feature-card p-8 rounded-2xl">
        <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center mb-5">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
        </div>
        <h3 class="text-xl font-semibold mb-3 text-gray-800">Mahasiswa Cerdas</h3>
        <p class="text-gray-600">Bergabung dengan berbagai mahasiswa yang peduli dengan sesama.</p>
      </div>
    </section>
    
    <!-- Testimonial Section -->
    <section class="bg-white rounded-2xl p-8 shadow-xl mb-20">
      <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Apa Kata Mereka?</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">Dengarkan pengalaman pembeli dan penjual di WarungKampus</p>
      </div>
      
      <div class="grid md:grid-cols-2 gap-8">
        <div class="bg-blue-50 p-6 rounded-xl">
          <div class="flex items-start mb-4">
            <img src="{{ asset('./assets/testi1.jpg') }}" alt="Testimonial" class="w-12 h-12 rounded-full mr-4">
            <div>
              <h4 class="font-semibold">Faisal Masri Maulana</h4>
              <p class="text-sm text-gray-500">Mahasiswa Pendidikan Matematika</p>
            </div>
          </div>
          <p class="text-gray-700 italic">"WarungKampus sangat membantu saya, terutama saat butuh perlengkapan kuliah tapi dana terbatas. Saya bisa dapat barang bekas berkualitas dengan harga jauh lebih murah daripada beli baru. Jadi, saya tetap bisa hemat tapi tetap lengkap untuk kuliah."</p>
        </div>
        
        <div class="bg-green-50 p-6 rounded-xl">
          <div class="flex items-start mb-4">
            <img src="{{ asset('./assets/testi2.jpg') }}" alt="Testimonial" class="w-12 h-12 rounded-full mr-4">
            <div>
              <h4 class="font-semibold">M. Fauzi Gafar</h4>
              <p class="text-sm text-gray-500">Mahasiswa Sistem Informasi </p>
            </div>
          </div>
          <p class="text-gray-700 italic">“Sebagai mahasiswa yang punya keahlian desain grafis, WarungKampus memudahkan saya menawarkan jasa ke teman-teman kampus. Saya bisa dapat penghasilan tambahan tanpa harus keluar dari lingkungan kampus, plus lebih mudah membangun relasi dengan pelanggan yang juga mahasiswa.”</p>
        </div>
      </div>
    </section>
    
    <!-- CTA Section -->
    <section class="text-center">
      <h2 class="text-3xl font-bold text-gray-800 mb-6">Siap Menjadi Bermanfaat dan Memperoleh Manfaat?</h2>
      <p class="text-gray-600 max-w-2xl mx-auto mb-8">
        Bergabunglah dengan mahasiswa-mahasiswi dalam jaringan WarungKampus dan rasakan sendiri manfaat yang sangat luar biasa.
      </p>
      <div class="flex justify-center gap-20">
        <x-button href="{{route('user.post')}}" color="primary" size="xl">
          Mulai Jual Sekarang
        </x-button>
        <x-button href="{{route('produk.list')}}" color="success" size="xl">
          Jelajahi Produk
        </x-button>
      </div>
    </section>
  </div>
</div>

@endsection