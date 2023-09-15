<div>
    @can('admin')
        <livewire:status-form></livewire:status-form>
    @endcan

    <div x-data @page-updated.window="$el.scrollIntoView({behavior: 'smooth'})">
        <livewire:status-filter></livewire:status-filter>

        @foreach($this->statuses as $status)
            @include('status.item')
        @endforeach

        <p>
            {{ $this->statuses->links() }}
        </p>
    </div>
</div>
