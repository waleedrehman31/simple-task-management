<div x-data="{ open: false }" @open-edit-task-modal.window="open = true; $wire.setTask($event.detail.id)"
    @task-updated.window="open = false" class="relative">
    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div @click.outside="open = false"
            class="bg-white rounded-2xl p-6 w-full max-w-lg shadow-lg space-y-5 transition">

            <h2 class="text-xl font-bold text-gray-800">Edit Task</h2>

            <div class="space-y-4">

                <x-form-input type="text" model="title" />

                <x-form-textarea model="description" placeholder="Task Description (optional)" />

                <x-form-select placeholder="" model="selectedTags" :options="$tags" multiple height="8rem" />

            </div>

            <div class="flex justify-end gap-3">

                <x-button @click="open=false" variant="light">
                    Cancel </x-button>

                <x-button wire:click="update" wire:loading.attr="disabled" type="submit">
                    Update Task </x-button>

            </div>
        </div>
    </div>
</div>
