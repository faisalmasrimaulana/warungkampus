@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8 pt-24">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Kolom Gambar -->
      <div class="md:col-span-1">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
          <img src="{{asset('assets/sepatu.jpg')}}" alt="Sepatu Casual" class="w-full h-auto" />
        </div>
      </div>

      <!-- Kolom Informasi -->
      <div class="md:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow-md p-6">
          <div class="flex justify-between items-start">
            <div>
              <h1 class="text-2xl font-bold text-gray-800 mb-1">Sepatu Casual Unisex</h1>
              <p class="text-sm text-gray-500 mb-3">Fashion - Sepatu</p>
            </div>
            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Tersedia</span>
          </div>

          <div class="mb-6">
            <p class="text-3xl font-bold text-blue-600">Rp 250.000</p>
            <p class="text-sm text-gray-500 mt-1">Harga sudah termasuk pajak</p>
          </div>

          <p class="text-gray-700 mb-6">
            Sepatu casual dengan desain modern dan nyaman dipakai. Cocok digunakan untuk kegiatan sehari-hari maupun acara santai.
          </p>

          <a href="https://wa.link/oicr0f"
             class="block whatsapp-button bg-green-500 text-center text-white py-3 px-6 rounded-lg font-medium items-center justify-center">
            <i data-feather="message-circle"></i>
            Hubungi Penjual via WhatsApp
          </a>
        </div>
      </div>

      <!-- Kolom Tentang Penjual Diperlebar -->
      <div class="md:col-span-3 bg-white rounded-xl shadow-md p-6 seller-card">
        <h3 class="font-semibold text-lg mb-4">Tentang Penjual</h3>
        <div class="flex items-center space-x-4">
          <img src="{{asset('assets/testi2.jpg')}}" alt="Penjual" class="w-12 h-12 rounded-full border-2 border-blue-100" />
          <div>
            <h4 class="font-medium">M. Fauzi Gafar</h4>
            <p class="text-sm text-gray-500">Mahasiswa Sistem Informasi</p>
          </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-100">
          <div class="flex items-center text-sm text-gray-600 mb-2">
            <i data-feather="map-pin" class="w-4 h-4 mr-2"></i>
            <span>Perumahan Grand Fazs Mecca, Mendalo</span>
          </div>
          <div class="flex items-center text-sm text-gray-600">
            <i data-feather="clock" class="w-4 h-4 mr-2"></i>
            <span>Bergabung sejak Mei 2025</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Deskripsi Lengkap -->
    <div class="mt-8 bg-white rounded-xl shadow-md p-6">
      <h2 class="text-xl font-semibold text-gray-800 mb-4">Deskripsi Produk</h2>
      <div class="prose max-w-none text-gray-700">
        <p>
          Sepatu Casual Unisex ini merupakan produk berkualitas tinggi yang dirancang khusus untuk kenyamanan sehari-hari. Dibuat dengan bahan premium yang membuatnya tahan lama dan nyaman digunakan dalam berbagai aktivitas.
        </p>

        <h3 class="font-medium mt-4">Spesifikasi Produk:</h3>
        <ul class="list-disc pl-5 space-y-1">
          <li>Bahan utama: Kanvas berkualitas tinggi</li>
          <li>Sole: Karet anti slip</li>
          <li>Berat: 400 gram/pasang</li>
        </ul>

        <h3 class="font-medium mt-4">Keunggulan Produk:</h3>
        <ul class="list-disc pl-5 space-y-1">
          <li>Desain ergonomis untuk kenyamanan maksimal</li>
          <li>Sol karet yang fleksibel dan tahan lama</li>
          <li>Bahan yang breathable sehingga tidak panas</li>
          <li>Cocok untuk berbagai aktivitas sehari-hari</li>
        </ul>

        <p class="mt-4">
          Produk ini sangat cocok untuk mahasiswa yang menginginkan sepatu casual yang stylish namun tetap nyaman digunakan seharian di kampus. Dapatkan sepatu berkualitas dengan harga terjangkau hanya di Warungkampus!
        </p>
      </div>
    </div>
  </div>
  @endsection