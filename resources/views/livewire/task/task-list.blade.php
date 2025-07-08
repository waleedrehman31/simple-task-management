<div class="max-w-5xl mx-auto p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <input type="text" wire:model.live.debounce="search" placeholder="Search tasks..."
            class="w-full md:w-1/3 py-2 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm" />
        <div class="flex flex-wrap gap-2 ">
            <select wire:model.live="statusFilter"
                class="py-2 px-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm w-full">
                <option value="">All Statuses</option>
                <option value="1">Completed</option>
                <option value="0">Incomplete</option>
            </select>
            <select wire:model.live="sortOrder"
                class="py-2 px-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm w-full">
                <option value="desc">Sort: Latest</option>
                <option value="asc">Sort: Oldest</option>
            </select>
        </div>
    </div>
    <button
        class="mb-6 py-3 px-6 bg-blue-600 hover:bg-blue-700 rounded-xl text-white font-semibold shadow-md transition">
        + Create Task
    </button>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($tasks as $task)
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
                <button wire:click="markAsComplete({{ $task->id }})"
                    class="flex-1 py-2 px-3 bg-green-500 hover:bg-green-600 text-white rounded-lg text-xs font-semibold transition shadow-sm">
                    Mark Complete
                </button>
                @else
                <span
                    class="flex-1 py-2 px-3 bg-green-100 text-green-700 rounded-lg text-xs font-semibold text-center cursor-not-allowed">
                    Completed
                </span> @endif
                <button
                    class="flex-1 py-2 px-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg text-xs font-semibold transition shadow-sm">
                    Edit
                </button>
                <button
                    class="flex-1 py-2 px-3 bg-red-500 hover:bg-red-600 text-white rounded-lg text-xs font-semibold transition shadow-sm"
                    wire:click="delete({{ $task->id }})">
                    Delete
                </button>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center text-gray-400 text-sm">No tasks found.</div>
        @endforelse
    </div>
</div>
