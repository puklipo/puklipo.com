<div>
    @can('admin')
        <livewire:status-form></livewire:status-form>
    @endcan

    <div x-data @page-updated.window="$el.scrollIntoView({behavior: 'smooth'})">
        <livewire:status-filter></livewire:status-filter>

        @foreach($statuses as $status)
            @include('status.item')
        @endforeach

        <p>
            {{ $statuses->links() }}
        </p>
    </div>
</div>
