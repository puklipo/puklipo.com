<div>
    @foreach($statuses as $status)
        @include('status.item')
    @endforeach

    <p>
        {{ $statuses->links() }}
    </p>
</div>
