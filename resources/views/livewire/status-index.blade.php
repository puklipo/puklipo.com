<div>
    @canany(['admin', 'tips'])
        <livewire:status-create></livewire:status-create>
    @endcanany

    <div id="status">
        <livewire:status-filter></livewire:status-filter>

        @foreach($this->statuses as $status)
            @include('status.item')
        @endforeach

        <p>
            {{ $this->statuses->links(data: ['scrollTo' => '#status']) }}
        </p>
    </div>
</div>
