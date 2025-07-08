@props([
'model',
'options' => [],
'multiple' => false,
'placeholder' => '',
'height' => 'auto'
])

<div>
    <select wire:model="{{ $model }}" @if($multiple) multiple @endif {{ $attributes->merge(['class' => 'w-full py-2 px-3
        border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm']) }}
        style="height: {{ $height }}"
        >
        @if($placeholder)
        <option value="" disabled selected>{{ $placeholder }}</option>
        @endif

        @forelse($options as $option)
        <option value="{{ $option->id }}">{{ $option->name }}</option>
        @empty
        <option disabled>No options available</option>
        @endforelse
    </select>

    @error($model)
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
