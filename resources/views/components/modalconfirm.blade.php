@props([
    'title' => 'Konfirmasi',
    'message' => 'Apakah Anda yakin?',
    'identity' => 'confirmModal'
    ]);
    
<div id="{{$identity}}" class="fixed inset-0 bg-black/20 hidden items-center justify-center z-50">
  <div class="bg-white rounded-xl p-6 max-w-sm w-full mx-4">
    <h3 class="text-lg font-semibold mb-4" id="Title{{$identity}}">{{$title}}</h3>
    <p class="text-gray-600 mb-6" id="Message{{$identity}}">{{$message}}</p>
    <div class="flex justify-end space-x-3">
      {{$slot}}
    </div>
  </div>
</div>