@props(['type' => 'success', 'message' => ''])

@php
$styles = [
'success' => 'bg-green-100 text-green-800',
'error' => 'bg-red-100 text-red-800',
'warning' => 'bg-yellow-100 text-yellow-800',
'info' => 'bg-blue-100 text-blue-800',
];
@endphp

<div x-data="{ show: true }" x-show="show" x-transition
    class="mb-4 p-4 rounded-lg flex justify-between items-center {{ $styles[$type] }}">
    <span>{{ $message }}</span>
    <button @click="show=false" class="font-bold hover:opacity-70">
        &times;
    </button>
</div>