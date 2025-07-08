<div class="max-w-5xl mx-auto p-6">

    @if (session()->has('success'))
    <div x-data="{ show: true }" x-show="show" x-transition
        class="mb-4 p-4 rounded-lg bg-green-100 text-green-800 flex justify-between items-center">
        <span>{{ session('success') }}</span>
        <button @click="show = false" class="text-green-800 hover:text-green-600">
            &times;
        </button>
    </div>
    @endif

    @if (session()->has('error'))
    <div x-data="{ show: true }" x-show="show" x-transition
        class="mb-4 p-4 rounded-lg bg-red-100 text-red-800 flex justify-between items-center">
        <span>{{ session('error') }}</span>
        <button @click="show = false" class="text-red-800 hover:text-red-600">
            &times;
        </button>
    </div>
    @endif

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

    <div class="flex space-x-1">
        <livewire:task.create-task-form />
        <livewire:task.import-tasks-form />
    </div>
    <div wire:loading.flex wire:target="search, statusFilter, sortOrder, nextPage, previousPage, gotoPage"
        class="flex justify-center items-center p-6 col-span-full">
        <div class="text-blue-600 font-medium animate-pulse">Loading tasks...</div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($tasks as $task)
        <x-task-card :task=$task />
        @empty
        <div class="col-span-full text-center text-gray-400 text-sm">No tasks found.</div>
        @endforelse
        <div class="mt-6 col-span-full">
            {{ $tasks->links() }} </div>

        <livewire:task.edit-task-model />

    </div>
</div>
