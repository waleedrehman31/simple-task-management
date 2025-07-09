@props([
'model',
'placeholder' => '',
'type' => 'text',
'label' => ''
])

<div>
    <label for="{{ $label }}">{{ $label }}</label>
    <textarea wire:model.defer="{{ $model }}" placeholder="{{ $placeholder }}" rows="4"
        class="w-full py-2 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm"></textarea>
    @error($model)
    <p class="text-red-500 text-xs">{{ $message }}</p>
    @enderror
</div>