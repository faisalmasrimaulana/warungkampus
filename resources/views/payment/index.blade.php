@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10">
    <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Pembayaran</h2>
        <p class="mb-4">Klik tombol di bawah untuk melanjutkan ke pembayaran.</p>
        <button id="pay-button" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Bayar Sekarang
        </button>
    </div>
</div>

{{-- Midtrans JS --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').addEventListener('click', function () {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                alert("Pembayaran berhasil!");
                console.log(result);
                // Redirect atau logic lain
            },
            onPending: function(result){
                alert("Menunggu pembayaran...");
                console.log(result);
            },
            onError: function(result){
                alert("Pembayaran gagal!");
                console.log(result);
            },
            onClose: function(){
                alert('Kamu belum menyelesaikan pembayaran ☹️');
            }
        });
    });
</script>
@endsection
