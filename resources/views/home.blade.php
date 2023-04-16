<x-main-layout>
    @can('admin')
        <livewire:status-form></livewire:status-form>
    @endcan

    <livewire:status-index></livewire:status-index>
</x-main-layout>
