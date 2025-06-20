@extends("layouts.app")
<head>
  <title>Bantuan</title>
  @include("partials.head")
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    .accordion-content {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease-out;
    }
    .file-upload {
      border: 2px dashed #d1d5db;
      transition: all 0.3s;
    }
    .file-upload:hover {
      border-color: #3b82f6;
      background-color: #f8fafc;
    }
  </style>
</head>

@section("content")

    @if(session('success'))
      <x-successmodal></x-successmodal>
    @endif

<!-- Main Content -->
<div class="container mx-auto px-4 py-8 mt-20">
  <!-- FAQ Section -->
  <div class="bg-white rounded-lg shadow p-6 mb-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Pertanyaan yang Sering Diajukan</h2>
    
    <!-- FAQ Item 1 -->
    <div class="accordion-item mb-4 border-b border-gray-200 pb-4">
      <button class="accordion-header w-full flex justify-between items-center text-left font-medium text-lg text-gray-800 hover:text-blue-600 focus:outline-none">
        <span>Bagaimana cara mendaftar di WarungKampus?</span>
        <i class="fas fa-chevron-down transition-transform duration-300"></i>
      </button>
      <div class="accordion-content mt-2 text-gray-600">
        <p>Untuk mendaftar, ikuti langkah berikut:</p>
        <ol class="list-decimal pl-5 mt-2 space-y-1">
          <li>Klik tombol "Daftar" di pojok kanan atas halaman</li>
          <li>Isi formulir pendaftaran dengan data yang valid</li>
          <li>Verifikasi email Anda melalui link yang kami kirim</li>
          <li>Login dengan akun yang telah dibuat</li>
        </ol>
      </div>
    </div>

    <!-- FAQ Item 2 -->
    <div class="accordion-item mb-4 border-b border-gray-200 pb-4">
      <button class="accordion-header w-full flex justify-between items-center text-left font-medium text-lg text-gray-800 hover:text-blue-600 focus:outline-none">
        <span>Bagaimana cara memposting barang?</span>
        <i class="fas fa-chevron-down transition-transform duration-300"></i>
      </button>
      <div class="accordion-content mt-2 text-gray-600">
        <p>Posting barang sangat mudah:</p>
        <ol class="list-decimal pl-5 mt-2 space-y-1">
          <li>Login ke akun Anda</li>
          <li>Klik tombol "Jual Barang" di navigasi atas</li>
          <li>Isi detail barang (nama, harga, deskripsi, kategori)</li>
          <li>Upload foto barang (maksimal 5 foto)</li>
          <li>Klik "Terbitkan" untuk memposting</li>
        </ol>
      </div>
    </div>

    <!-- FAQ Item 3 -->
    <div class="accordion-item mb-4 border-b border-gray-200 pb-4">
      <button class="accordion-header w-full flex justify-between items-center text-left font-medium text-lg text-gray-800 hover:text-blue-600 focus:outline-none">
        <span>Apa yang harus dilakukan jika menemukan penipuan?</span>
        <i class="fas fa-chevron-down transition-transform duration-300"></i>
      </button>
      <div class="accordion-content mt-2 text-gray-600">
        <p>Jika Anda menemukan indikasi penipuan:</p>
        <ol class="list-decimal pl-5 mt-2 space-y-1">
          <li>Jangan melanjutkan transaksi</li>
          <li>Kumpulkan bukti transaksi (screenshot chat, bukti transfer)</li>
          <li>Laporkan melalui form di bawah halaman ini</li>
          <li>Hubungi admin melalui WhatsApp: 0812-3456-7890</li>
        </ol>
        <p class="mt-2 text-red-500">Kami akan menindaklanjuti dalam 1x24 jam.</p>
      </div>
    </div>



  <!-- Help Form Section -->
  <div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Formulir Laporan</h2>
    <p class="text-gray-600 mb-6">Silakan isi form berikut untuk melaporkan masalah yang Anda temui.</p>
    
    <form method="POST" action="{{route('bantuan.process')}}" enctype="multipart/form-data" class="space-y-4">
      @csrf
      <!-- Name Field -->
      <div>
        <x-input type="text" name="nama" label="Nama Lengkap*"/>
      </div>
      
      <!-- Email Field -->
      <div>
        <x-input type="email"  name="email" label="Email *" />
      </div>
      
      <!-- Message Field -->
      <div>
        <label for="detail_laporan" class="block text-sm font-medium text-gray-700 mb-1">Detail Laporan</label>
        <textarea id="detail_laporan" name="detail_laporan" rows="5" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Jelaskan masalah Anda secara detail..." >{{old('detail_laporan')}}</textarea>
      </div>
      
      <!-- File Upload -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Upload Bukti</label>
        <div class="file-upload rounded-lg p-4 text-center cursor-pointer">
          <input type="file" id="bukti" name="bukti" accept="image/*,.pdf" class="hidden">
          <div class="flex flex-col items-center">
            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
            <p class="text-sm text-gray-600">Seret file ke sini atau klik untuk mengunggah</p>
            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, PDF (maks. 5MB)</p>
          </div>
        </div>
        <div id="filePreview" class="mt-2 hidden">
          <p class="text-sm text-gray-600">File terpilih: <span id="fileName"></span></p>
        </div>
      </div>
      
      <!-- Action Buttons -->
      <div class="flex space-x-4 justify-end pt-2">
        <x-button type="button" href="{{route('cancel')}}" color="danger">
          Batal
        </x-button>
        <x-button type="submit">
          Kirim Laporan
        </x-button>
      </div>
    </form>
  </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Accordion functionality
    const accordionHeaders = document.querySelectorAll('.accordion-header');
    
    accordionHeaders.forEach(header => {
      header.addEventListener('click', function() {
        const content = this.nextElementSibling;
        const icon = this.querySelector('i');
        
        // Toggle content
        if (content.style.maxHeight) {
          content.style.maxHeight = null;
          icon.style.transform = 'rotate(0deg)';
        } else {
          content.style.maxHeight = content.scrollHeight + 'px';
          icon.style.transform = 'rotate(180deg)';
        }
      });
    });
    
    // File upload functionality
    const fileUpload = document.querySelector('.file-upload');
    const fileInput = document.getElementById('bukti');
    const filePreview = document.getElementById('filePreview');
    const fileName = document.getElementById('fileName');
    
    fileUpload.addEventListener('click', function() {
      fileInput.click();
    });
    
    fileInput.addEventListener('change', function() {
      if (this.files.length > 0) {
        fileName.textContent = this.files[0].name;
        filePreview.classList.remove('hidden');
      } else {
        filePreview.classList.add('hidden');
      }
    });
    
    // Drag and drop for file upload (optional enhancement)
    fileUpload.addEventListener('dragover', function(e) {
      e.preventDefault();
      this.classList.add('border-blue-500', 'bg-blue-50');
    });
    
    fileUpload.addEventListener('dragleave', function() {
      this.classList.remove('border-blue-500', 'bg-blue-50');
    });
    
    fileUpload.addEventListener('drop', function(e) {
      e.preventDefault();
      this.classList.remove('border-blue-500', 'bg-blue-50');
      
      if (e.dataTransfer.files.length) {
        fileInput.files = e.dataTransfer.files;
        fileName.textContent = e.dataTransfer.files[0].name;
        filePreview.classList.remove('hidden');
      }
    });
  });
</script>

@endsection
