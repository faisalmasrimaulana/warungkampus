@extends('layouts.app')

@section('content')
  <!-- IMAGE INPUT STYLE -->
  <style>
    .upload-area {
      border: 2px dashed #cbd5e0;
      transition: all 0.3s ease;
    }
    .upload-area:hover {
      border-color: #3b82f6;
      background-color: #f8fafc;
    }
    .upload-area.dragover {
      border-color: #3b82f6;
      background-color: #ebf5ff;
    }
</style>

<!-- POST PRODUCT -->
<section class="min-h-screen">

      <!-- CARD -->
  <x-formcard  method="POST" action="{{route('user.product.update', $product->id)}}" enctype="multipart/form-data" class="max-w-4xl mx-auto mt-30 mb-10">
          <h1 class="text-2xl font-bold text-gray-800 mb-6">Update Produk</h1>
          @csrf
          @method ('PUT')
          <div>
            <!-- EDIT FOTO PRODUK -->
            <label for="productImages" class="text-lg font-semibold text-gray-700 mb-3">Foto Produk</label>
            <div id="uploadArea" class="upload-area rounded-lg p-6 text-center cursor-pointer">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
              <p class="mt-2 text-sm text-gray-600">Klik atau tarik gambar ke sini</p>
              <p class="text-xs text-gray-500">Format: JPG, PNG (Maks. 5MB)</p>
              <input type="file" id="productImages" class="hidden" name="productImages[]" accept="image/*" multiple>
            </div>
            <div id="previewContainer" class="mt-4 gap-3 flex justify-center">
              <!-- Preview images will be inserted here -->
               @if($product->fotoproduk && count($product->fotoproduk))
                  @foreach($product->fotoproduk as $foto)
                    <div class="relative group inline-block">
                      <img src="{{ asset('storage/'. $foto->path_fotoproduk) }}" class="w-64 h-64 object-cover border-black mb-2 rounded-lg">
                     
                      <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition" onclick="removeOldImage(this)">
                        &times;
                      </button>
                      <input type="checkbox" name="deleted_fotos[]" value="{{ $foto->id }}" class="hidden delete-checkbox">
                    </div>
                  @endforeach
                @endif
            </div>
          </div>
          <!-- ./EDIT FOTO PRODUK -->

          <!-- Informasi Dasar -->
           <div class="max-w-4xl mx-auto">
             <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
               <!-- Nama produk -->
               <div>
                 <x-input label="Nama Produk*" type="text" name="nama_produk" class="w-full px-4 py-2" placeholder="Contoh: Sepatu Sneakers Casual" value="{{$product->nama_produk}}"/>
               </div>
               <!-- ./Nama Produk -->
   
               <!-- Harga Produk -->
               <div>
                 <x-input label="Harga*" type="number" name="harga" id="productPrice" class="w-full px-4 py-2" placeholder="Contoh: 250000" value="{{$product->harga}}"/>
               </div>
               <!-- ./Harga Produk -->
   
               <!-- Kategori Produk -->
               <div>
                 <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                 <select id="productCategory" name="kategori" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                   <option value="" disabled selected {{old('kategori', $product->kategori) == '' ? 'selected' : ''}}>Pilih kategori</option>
                   <option value="barang" {{old('kategori', $product->kategori) == 'barang' ? 'selected' : ''}}>Barang</option>
                   <option value="jasa" {{old('kategori', $product->kategori) == 'jasa' ? 'selected' : ''}}>Jasa</option>
                 </select>
               </div>
               <!-- ./Kategori Produk -->
   
               <!-- product Condition -->
               <div>
                 <label for="kondisi" class="block text-sm font-medium text-gray-700 mb-1">Kondisi</label>
                 <select id="productCondition" name="kondisi" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                   <option value="baru" {{old('kondisi', $product->kondisi) == 'baru' ? 'selected' : ''}}>Baru</option>
                   <option value="bekas" {{old('kondisi', $product->kondisi) == 'bekas' ? 'selected' : ''}}>Bekas</option>
                 </select>
               </div>
               <!-- product Condition -->
             </div>
           </div>
  
          <!-- Deskripsi -->
          <div>
            <x-input label="Deskripsi singkat*" type="text" name="deskripsi_singkat" id="shortDescription" class="w-full px-4 py-2" placeholder="Contoh: Sepatu casual warna hitam, ukuran 40, kondisi 90%" maxlength="100" value="{{$product->deskripsi_singkat}}"/>
            <p class="text-xs text-gray-500 mt-1">Maksimal 100 karakter</p>
          </div>
  
          <div>
            <label for="deskripsi_lengkap" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Lengkap</label>
            <textarea id="fullDescription" name="deskripsi_lengkap" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Jelaskan detail produk, spesifikasi, kelebihan, dll." name="fullDescription">{{$product->deskripsi_lengkap}}</textarea>
          </div>
  
  
          <!-- Submit Button -->
          <div class="pt-4 flex justify-end gap-3">
            <x-button type="submit" color="primary">
              Update Produk
            </x-button>
            <x-button href="{{url()->previous()}}" color="danger">Batal</x-button>
          </div>
        <!-- </form> -->
  </x-formcard>

  <script>

      // Image upload functionality
      const uploadArea = document.getElementById('uploadArea');
      const fileInput = document.getElementById('productImages');
      const previewContainer = document.getElementById('previewContainer');

      if (uploadArea && fileInput && previewContainer) {
        // Click event
        uploadArea.addEventListener('click', () => fileInput.click());

        // Drag and drop events
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
          uploadArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
          e.preventDefault();
          e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
          uploadArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
          uploadArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight() {
          uploadArea.classList.add('dragover');
        }

        function unhighlight() {
          uploadArea.classList.remove('dragover');
        }

        // Handle dropped files
        uploadArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
          const dt = e.dataTransfer;
          const files = dt.files;
          handleFiles(files);
        }

        // Handle selected files
        fileInput.addEventListener('change', function() {
          handleFiles(this.files);
        });

        function handleFiles(files) {
          if (files.length > 5) {
            alert('Maksimal 5 gambar yang dapat diunggah');
            return;
          }
          
          previewContainer.innerHTML = '';
          
          Array.from(files).forEach(file => {
            if (!file.type.match('image.*')) {
              return;
            }
            
            const reader = new FileReader();
            
            reader.onload = function(e) {
              const previewDiv = document.createElement('div');
              previewDiv.className = 'relative group inline-block';
              
              const img = document.createElement('img');
              img.src = e.target.result;
              img.className = 'w-64 h-64 object-cover border border-black mb-2 rounded-lg';
              
              const removeBtn = document.createElement('button');
              removeBtn.className = 'absolute top-1 right-1 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition';
              removeBtn.innerHTML = '&times;';
              removeBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                previewDiv.remove();
                if (previewContainer.children.length === 0) {
                  previewContainer.classList.add('hidden');
                }
              });
              
              previewDiv.appendChild(img);
              previewDiv.appendChild(removeBtn);
              previewContainer.appendChild(previewDiv);
            }
            
            reader.readAsDataURL(file);
          });
          
          if (files.length > 0) {
            previewContainer.classList.remove('hidden');
          }
        }
      }

      // Form submission

      // Disable Condition Category
      const kategori = document.querySelector("#productCategory");
      const kondisi = document.querySelector("#productCondition");

      kategori.addEventListener('change', function(){
        if(this.value=== 'jasa'){
          kondisi.disabled = true;
          kondisi.classList.add('bg-gray-100', 'text-gray-400', 'cursor-not-allowed', 'border-gray-300');
        }
        else{
          kondisi.disabled = false;
          kondisi.classList.remove('bg-gray-100', 'text-gray-400', 'cursor-not-allowed', 'border-gray-300');
        }
      })

      function removeOldImage(button) {
        const container = button.parentElement;
        const checkbox = container.querySelector('.delete-checkbox');
        if (checkbox) {
          checkbox.checked = true; // tandai supaya backend hapus gambar ini
        }
        container.style.display = 'none'; // sembunyikan dari UI
      }
  </script>

</section>
@endsection