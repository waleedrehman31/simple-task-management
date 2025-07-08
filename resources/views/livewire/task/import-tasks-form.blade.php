<div x-data="{ open: false, showSuccess: false, showError: false }" @task-imported.window="open = false">
    <button @click="open = true"
        class="mb-6 py-3 px-6 bg-blue-600 hover:bg-blue-700 rounded-xl text-white font-semibold shadow-md transition">
        Import Tasks
    </button>

    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div @click.outside="open = false"
            class="bg-white rounded-2xl p-6 w-full max-w-lg shadow-lg space-y-5 transition">

            <h2 class="text-xl font-bold text-gray-800">Import Tasks from Excel</h2>

            <form wire:submit.prevent="import" class="space-y-4">
                <input type="file" wire:model="file"
                    class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" />

                @error('file') <p class="text-red-500 text-xs">{{ $message }}</p> @enderror

                <div class="flex justify-end gap-3">
                    <button type="button" @click="open = false"
                        class="py-2 px-4 bg-gray-200 hover:bg-gray-300 rounded-lg text-gray-700 text-sm font-medium transition">
                        Cancel
                    </button>
                    <button type="submit"
                        class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition flex items-center">
                        <span wire:loading.remove wire:target="import">Import Tasks</span>
                        <span wire:loading wire:target="import" class="animate-pulse">Importing...</span>
                    </button>
                </div>
            </form>

            <div wire:loading wire:target="import" class="w-full mt-4 bg-gray-200 rounded-lg overflow-hidden h-3">
                <div class="h-full bg-blue-500 animate-pulse" style="width: 100%"></div>
            </div>

            @if ($successMessage)
            <div x-show="showSuccess" x-init="showSuccess = true" x-transition
                class="mt-4 p-3 bg-green-100 text-green-800 rounded-lg flex justify-between items-center">
                <span>{{ $successMessage }}</span>
                <button @click="showSuccess = false" class="text-green-800">&times;</button>
            </div>
            @endif

            @if ($errorMessage)
            <div x-show="showError" x-init="showError = true" x-transition
                class="mt-4 p-3 bg-red-100 text-red-800 rounded-lg flex justify-between items-center">
                <span>{{ $errorMessage }}</span>
                <button @click="showError = false" class="text-red-800">&times;</button>
            </div>
            @endif

        </div>
    </div>
</div>
