<div x-data="{ open: false }" @task-created.window="open = false" class="relative">

    <x-button @click="open=true"><i class="fa-solid fa-plus me-2"></i> Create Task</x-button>

    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div @click.outside="open = false"
            class="bg-white rounded-2xl p-6 w-full max-w-lg shadow-lg space-y-5 transition">

            <h2 class="text-xl font-bold text-gray-800">Create New Task</h2>

            <div class="space-y-4">

                <x-form-input label="Task Title" model="title" placeholder="Task Title" />

                <x-form-textarea label="Task Description" model="description"
                    placeholder="Task Description (optional)" />

                <x-form-input type="date" label="Start Date" model="startDate" placeholder="Start Date" />
                <x-form-input type="date" label="End Date" model="endDate" placeholder="End Date" />

                <x-form-select label="Tags" model="selectedTags" :options="$tags" multiple height="8rem" />

            </div>
            <div class="flex justify-end gap-3">

                <x-button @click="open=false" variant="light">
                    Cancel </x-button>

                <x-button wire:click="save" type="submit">
                    Save Task </x-button>

            </div>
        </div>
    </div>
</div>
