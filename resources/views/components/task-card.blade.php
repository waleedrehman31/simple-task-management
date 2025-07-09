<div wire:key="{{ $task->id }}"
    class="flex flex-col justify-between bg-white border border-gray-200 rounded-2xl p-5 shadow-sm hover:shadow-lg transition group">
    <div>

        <h2 class="text-lg font-bold text-gray-800 mb-1 group-hover:text-blue-600 transition">{{ $task->title }}
        </h2>

        <p class="text-sm text-gray-600 mb-2">{{ $task->description }}</p>

        <p class="text-sm mb-3">
            <span class="font-medium text-gray-500">Status:</span>
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold
                {{ $task->is_completed ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                {{ $task->status }}
            </span>
        </p>

        <div class="flex flex-wrap gap-2 mt-3">
            @forelse ($task->tags as $tag)
            <span
                class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full hover:bg-blue-200 transition">
                {{ $tag->name }}
            </span>
            @empty
            <span class="text-xs text-gray-400">No tags</span>
            @endforelse
        </div>

    </div>

    <div class="flex flex-wrap gap-2 mt-5">

        @if (!$task->is_completed)
        <x-button class="flex-1 text-xs" variant="success" wire:click="markAsComplete({{ $task->id }})"
            wire:loading.attr="disabled" wire:target="markAsComplete({{ $task->id }})">
            <span wire:loading.remove wire:target="markAsComplete({{ $task->id }})">
                <i class="fa-solid fa-square-check me-1"></i> Mark Complete
            </span>
            <span wire:loading.inline wire:target="markAsComplete({{ $task->id }})">Marking...</span>
        </x-button>
        @else
        <span
            class="flex-1 py-2 px-3 bg-green-100 text-green-700 rounded-lg text-xs font-semibold text-center cursor-not-allowed">
            Completed
        </span>
        @endif

        <x-button class="text-xs" variant="warning" @click="$dispatch('open-edit-task-modal', { id: {{ $task->id }} })">
            <i class="fa-solid fa-pencil me-1"></i> Edit
        </x-button>

        <x-button class="text-xs" variant="danger" wire:confirm="Are you sure you want to delete this?"
            wire:click="delete({{ $task->id }})" wire:loading.attr="disabled" wire:target="delete({{ $task->id }})">
            <span wire:loading.remove wire:target="delete({{ $task->id }})">
                <i class="fa-solid fa-trash-can me-1"></i> Delete
            </span>
            <span wire:loading.inline wire:target="delete({{ $task->id }})">Deleting...</span>
        </x-button>

    </div>
</div>