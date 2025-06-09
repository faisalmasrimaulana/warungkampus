<div id="modal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
<div class="bg-white rounded-xl p-6 max-w-sm w-full mx-4 shadow-lg">
    <h3 class="text-lg font-semibold mb-4">Berhasil!</h3>
    <p class="text-gray-700 mb-6">{{ session('success') }}</p>
    <div class="flex justify-end">
        <x-button id="closeModal" color="danger">Tutup</x-button>
    </div>
</div>
</div>

<script>
document.getElementById('closeModal').addEventListener('click', function() {
    document.getElementById('modal').style.display = 'none';
});
</script>