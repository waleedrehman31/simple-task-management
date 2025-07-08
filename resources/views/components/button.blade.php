@props([
'type' => 'button',
'variant' => 'primary'
])

@php
$variants = [
'primary' => 'bg-blue-600 text-white hover:bg-blue-500 focus:ring-blue-400',
'secondary' => 'bg-gray-600 text-white hover:bg-gray-500 focus:ring-gray-400',
'success' => 'bg-green-600 text-white hover:bg-green-500 focus:ring-green-400',
'danger' => 'bg-red-600 text-white hover:bg-red-500 focus:ring-red-400',
'warning' => 'bg-yellow-500 text-black hover:bg-yellow-400 focus:ring-yellow-300',
'light' => 'bg-gray-200 hover:bg-gray-300 rounded-lg text-gray-700',
];
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 rounded-lg font-medium
    focus:outline-none focus:ring-2 focus:ring-offset-2 transition '.$variants[$variant]]) }}>
    {{ $slot }}
</button>
