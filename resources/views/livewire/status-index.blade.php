<div>
    @can('admin')
        <livewire:status-form></livewire:status-form>
    @endcan

    <div>
        <livewire:status-filter></livewire:status-filter>

        @foreach($this->statuses as $status)
            @include('status.item')
        @endforeach

        <p>
            {{ $this->statuses->links() }}
        </p>
    </div>
</div>
