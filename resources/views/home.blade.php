<x-main-layout>
    <div class="py-12">
        <div class="mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Home") }}
                </div>
            </div>
        </div>
    </div>

    @auth
        <livewire:status-form></livewire:status-form>
    @endauth
</x-main-layout>
