<div x-data="{ open: false }" @task-created.window="open = false" class="relative">
    <button @click="open = true"
        class="mb-6 py-3 px-6 bg-blue-600 hover:bg-blue-700 rounded-xl text-white font-semibold shadow-md transition">
        + Create Task
    </button>

    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div @click.outside="open = false"
            class="bg-white rounded-2xl p-6 w-full max-w-lg shadow-lg space-y-5 transition">
            <h2 class="text-xl font-bold text-gray-800">Create New Task</h2>

            <div class="space-y-4">
                <input type="text" wire:model.defer="title" placeholder="Task Title"
                    class="w-full py-2 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm" />
                @error('title') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror

                <textarea wire:model.defer="description" placeholder="Task Description (optional)" rows="4"
                    class="w-full py-2 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm"></textarea>
                @error('description') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror
            </div>
            <select wire:model="selectedTags" multiple
                class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm h-32">
                @forelse ($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @empty
                <option disabled>No tags available</option>
                @endforelse
            </select>
            @error('selectedTags') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror

            <div class="flex justify-end gap-3">
                <button @click="open = false"
                    class="py-2 px-4 bg-gray-200 hover:bg-gray-300 rounded-lg text-gray-700 text-sm font-medium transition">Cancel</button>
                <button wire:click="save"
                    class="py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-semibold transition">Save
                    Task</button>
            </div>
        </div>
    </div>
</div>
