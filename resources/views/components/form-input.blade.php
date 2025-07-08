@props([
'model',
'placeholder' => '',
'type' => 'text'
])

<div>
    <input type="{{ $type }}" wire:model.defer="{{ $model }}" placeholder="{{ $placeholder }}" {{
        $attributes->merge(['class' => 'w-full py-2 px-4 border border-gray-300 rounded-lg focus:ring-2
    focus:ring-blue-400 focus:outline-none shadow-sm']) }}
    />

    @error($model)
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
