@props(['type' => 'text', 'name', 'value' => '', 'placeholder' => '', 'required' => false])

<input type="{{ $type }}" name="{{ $name }}" placeholder="{{ $placeholder }}" 
    {{ $required ? 'required' : '' }} 
    class="border text-sm p-2 rounded-md border-blue-500 w-full mb-3">