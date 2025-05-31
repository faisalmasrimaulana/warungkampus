<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('hidden');
}
</script>

<div class="flex justify-end space-x-2">
    <form id="filterForm" method="GET" action="{{ route('produk.filter') }}">
        <div id="sidebar" class="hidden absolute z-10 top-[110px] left-8 w-64 bg-white border rounded shadow-lg p-4">
        <div class="flex justify-end mb-4">
        <button onclick="toggleSidebar()" class="text-sm text-red-600 hover:underline hover:cursor-pointer" aria-label="Close">✖</button>
        </div>

        <!-- ALL -->
        <label class="cursor-pointer flex items-center space-x-2 rounded px-2 py-1 mb-2 hover:bg-blue-400 hover:text-white">
            <input type="radio" name="kategori" class="kategori-radio sr-only" value="" {{ request('kategori', '') == '' ? 'checked' : '' }}>
            <span>Semua</span>
        </label>

        <!-- KATEGORI -->
        <h2 class="text-lg font-semibold mb-2">Kategori</h2>
        <ul id="kategori-list" class="space-y-2 mb-4 text-blue-800">
            <li>
                <label class="cursor-pointer flex items-center space-x-2 rounded px-2 py-1 hover:bg-blue-400 hover:text-white">
                    <input type="radio" name="kategori" class="kategori-radio sr-only" value="Barang" {{ request('kategori') == 'Barang' ? 'checked' : '' }}>
                    <span>barang</span>
                </label>
            </li>
            <li>
                <label class="cursor-pointer flex items-center space-x-2 rounded px-2 py-1 hover:bg-blue-400 hover:text-white">
                    <input type="radio" name="kategori" class="kategori-radio sr-only" value="Jasa" {{ request('kategori') == 'Jasa' ? 'checked' : '' }}>
                    <span>jasa</span>
                </label>
            </li>
        </ul>

        <!-- HARGA -->
        <h2 class="text-lg font-semibold mb-2">Urutkan Harga</h2>
        <ul id="harga-list" class="space-y-2 mb-4 text-blue-800">
            <li>
                <label class="cursor-pointer flex items-center space-x-2 rounded px-2 py-1 hover:bg-blue-400 hover:text-white">
                    <input type="radio" name="harga" class="harga-radio sr-only" value="Terendah" {{ request('harga') == 'Terendah' ? 'checked' : '' }}>
                    <span>Terendah</span>
                </label>
            </li>
            <li>
                <label class="cursor-pointer flex items-center space-x-2 rounded px-2 py-1 hover:bg-blue-400 hover:text-white">
                    <input type="radio" name="harga" class="harga-radio sr-only" value="Tertinggi" {{ request('harga') == 'Tertinggi' ? 'checked' : '' }}>
                    <span>Tertinggi</span>
                </label>
            </li>
        </ul>

        <!-- WAKTU -->
        <h2 class="text-lg font-semibold mb-2">Urutkan Waktu</h2>
        <ul id="waktu-list" class="space-y-2 text-blue-800 mb-4">
            <li>
                <label class="cursor-pointer flex items-center space-x-2 rounded px-2 py-1 hover:bg-blue-400 hover:text-white">
                    <input type="radio" name="waktu" class="waktu-radio sr-only" value="Terbaru" {{ request('waktu') == 'Terbaru' ? 'checked' : '' }}>
                    <span>Terbaru</span>
                </label>
            </li>
            <li>
                <label class="cursor-pointer flex items-center space-x-2 rounded px-2 py-1 hover:bg-blue-400 hover:text-white">
                    <input type="radio" name="waktu" class="waktu-radio sr-only" value="Terlama" {{ request('waktu') == 'Terlama' ? 'checked' : '' }}>
                    <span>Terlama</span>
                </label>
            </li>
        </ul>

        <div class="flex justify-end space-x-2">
            <x-button type="button" onclick="toggleSidebar()" class="px-3 py-1" color="danger">Batal</x-button>
            <x-button type="submit" color="primary">Oke</x-button>
        </div>
        </div>
    </form>
</div>

<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('hidden');
}

document.addEventListener('DOMContentLoaded', function() {
    setupRadioHighlight('.kategori-radio');
    setupRadioHighlight('.harga-radio');
    setupRadioHighlight('.waktu-radio');
});

function setupRadioHighlight(selector) {
    const radios = document.querySelectorAll(selector);
    radios.forEach(radio => {
        radio.addEventListener('change', () => {
            radios.forEach(r => {
                const label = r.closest('label');
                if (label) label.classList.remove('bg-blue-200', 'bg-blue-600', 'text-white');
            });
            const selected = document.querySelector(selector + ':checked');
            if (selected) {
                const label = selected.closest('label');
                if (label) label.classList.add('bg-blue-600', 'text-white');
            }
        });
    });
    // Highlight default
    const selected = document.querySelector(selector + ':checked');
    if (selected) {
        radios.forEach(r => {
            const label = r.closest('label');
            if (label) label.classList.remove('bg-blue-200', 'bg-blue-600', 'text-white');
        });
        const label = selected.closest('label');
        if (label) label.classList.add('bg-blue-600', 'text-white');
    }
}
</script>
