<div x-data="{ open: false, showSuccess: false, showError: false }" @task-imported.window="open = false">

    <x-button @click="open=true"><i class="fa-solid fa-file-import me-2"></i> Import Tasks</x-button>

    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div @click.outside="open = false"
            class="bg-white rounded-2xl p-6 w-full max-w-lg shadow-lg space-y-5 transition">

            <h2 class="text-xl font-bold text-gray-800">Import Tasks from Excel</h2>

            <form wire:submit.prevent="import" class="space-y-4">

                <x-form-input label="Upload File" type="file" model="file" />

                <div class="flex justify-end gap-3">

                    <x-button @click="open=false" variant="light">
                        Cancel </x-button>

                    <x-button wire:click="import" type="submit">
                        <span wire:loading.remove wire:target="import">Import Tasks</span>
                        <span wire:loading wire:target="import" class="animate-pulse">Importing...</span>
                    </x-button>

                </div>
            </form>

            <div wire:loading wire:target="import" class="w-full mt-4 bg-gray-200 rounded-lg overflow-hidden h-3">
                <div class="h-full bg-blue-500 animate-pulse" style="width: 100%"></div>
            </div>

            @if ($successMessage)
            <x-alert type="success" :message="$successMessage" />
            @endif

            @if ($errorMessage)
            <x-alert type="error" :message="$errorMessage" />
            @endif

        </div>
    </div>
</div>