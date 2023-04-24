<x-main-layout>
    <x-slot name="description">
        {{ config('app.name') }}
    </x-slot>

    @can('admin')
        <livewire:status-form></livewire:status-form>
    @endcan

    <livewire:status-index></livewire:status-index>
</x-main-layout>
