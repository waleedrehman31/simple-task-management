<div class="max-w-5xl mx-auto p-6">

    @if (session()->has('success'))
    <x-alert type="success" :message="session('success')" />
    @endif

    @if (session()->has('error'))
    <x-alert type="error" :message="session('error')" />
    @endif

    <x-task-filter :tags="$tags" />

    <div class="flex space-x-1 mb-3">
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
            {{ $tasks->links() }}
        </div>

        <livewire:task.edit-task-model />

    </div>
</div>