<div x-data @page-updated.window="$el.scrollIntoView({behavior: 'smooth'})">
    @foreach($statuses as $status)
        @include('status.item')
    @endforeach

    <p>
        {{ $statuses->links() }}
    </p>
</div>
