<a href="{{ route('produk.detail', ['id' => $prod->id]) }}">
    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-200 hover:scale-105">
        <img src="{{ asset('storage/' . $prod->thumbnail) }}" alt="{{ $prod->nama_produk }}" class="w-full h-32 object-cover">
        <div class="p-3">
            <h3 class="text-sm font-semibold truncate">{{ $prod->nama_produk }}</h3>
            <p class="text-xs text-gray-500">{{ $prod->created_at->format('d M Y') }}</p>
            <p class="text-xs text-gray-500 mb-2">{{ $prod->kategori }}{{ $prod->kondisi != 'nocondition' ? ' - ' . $prod->kondisi : '' }}</p>
            <p class="text-sm text-blue-700 font-bold mt-1"> {{$prod->harga_format }}</p>
            <p class="text-xs text-gray-500">{{ $prod->deskripsi_singkat }}</p>
        </div>
    </div>
</a>