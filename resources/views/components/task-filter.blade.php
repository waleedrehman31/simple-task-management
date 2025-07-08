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
        <select wire:model.live="tagFilter"
            class="py-2 px-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm w-full">
            <option value="">All Tags</option>
            @foreach ($tags as $tag)
            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>
</div>
