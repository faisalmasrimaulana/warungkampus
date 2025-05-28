<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('hidden');
}
</script>

<div id="sidebar" class="hidden absolute z-10 top-[110px] left-8 w-64 bg-white border rounded shadow-lg p-4">
    <div class="flex justify-end mb-4">
    <button onclick="toggleSidebar()" class="text-sm text-red-600 hover:underline">✖</button>
    </div>

    <h2 class="text-lg font-semibold mb-2">Kategori</h2>
    <ul id="kategori-list" class="space-y-2 mb-4 text-blue-800">
    <li>
        <label class="cursor-pointer flex items-center space-x-2 rounded px-2 py-1 hover:bg-blue-100">
        <input type="radio" name="kategori" class="kategori-radio hidden" value="Barang">
        <span>barang</span>
        </label>
    </li>
    <li>
        <label class="cursor-pointer flex items-center space-x-2 rounded px-2 py-1 hover:bg-blue-100">
        <input type="radio" name="kategori" class="kategori-radio hidden" value="Jasa">
        <span>jasa</span>
        </label>
    </li>
    </ul>

    <h2 class="text-lg font-semibold mb-2">Urutkan Harga</h2>
    <ul id="harga-list" class="space-y-2 mb-4 text-blue-800">
    <li><a href="#" data-value="Terendah" class="urut-harga block rounded px-2 py-1 hover:bg-blue-100 cursor-pointer">Terendah</a></li>
    <li><a href="#" data-value="Tertinggi" class="urut-harga block rounded px-2 py-1 hover:bg-blue-100 cursor-pointer">Tertinggi</a></li>
    </ul>

    <h2 class="text-lg font-semibold mb-2">Urutkan Waktu</h2>
    <ul id="waktu-list" class="space-y-2 text-blue-800 mb-4">
    <li><a href="#" data-value="Terbaru" class="urut-waktu block rounded px-2 py-1 hover:bg-blue-100 cursor-pointer">Terbaru</a></li>
    <li><a href="#" data-value="Terlama" class="urut-waktu block rounded px-2 py-1 hover:bg-blue-100 cursor-pointer">Terlama</a></li>
    </ul>

    <div class="flex justify-end space-x-2">
    <form id="filterForm" method="GET" action="{{ route('produk.filter') }}">
    <!-- Kategori -->
    <input type="hidden" name="kategori" id="filterKategori">
    <!-- Urutan Harga -->
    <input type="hidden" name="harga" id="filterHarga">
    <!-- Urutan Waktu -->
    <input type="hidden" name="waktu" id="filterWaktu">

    <div class="flex justify-end space-x-2">
        <x-button type="button" onclick="toggleSidebar()" class="px-3 py-1" color="danger">Batal</x-button>
        <x-button type="submit" color="primary">Oke</x-button>
    </div>
</form>

    </div>
</div>

<script>
    const hargaItems = document.querySelectorAll('.urut-harga');
    hargaItems.forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            hargaItems.forEach(i => i.classList.remove('bg-blue-200', 'text-white'));
            item.classList.add('bg-blue-200', 'text-white');
            document.getElementById('filterHarga').value = item.dataset.value; // fix di sini
        });
    });

    const waktuItems = document.querySelectorAll('.urut-waktu');
    waktuItems.forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            waktuItems.forEach(i => i.classList.remove('bg-blue-200', 'text-white'));
            item.classList.add('bg-blue-200', 'text-white');
            document.getElementById('filterWaktu').value = item.dataset.value; // fix di sini
        });
    });

    const kategoriRadios = document.querySelectorAll('.kategori-radio');
    kategoriRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            kategoriRadios.forEach(r => {
                const label = r.closest('label');
                label.classList.remove('bg-blue-200', 'text-white');
            });
            const selected = document.querySelector('.kategori-radio:checked');
            if (selected) {
                const label = selected.closest('label');
                label.classList.add('bg-blue-200', 'text-white');
                document.getElementById('filterKategori').value = selected.value; // fix di sini
            }
        });
    });
</script>
