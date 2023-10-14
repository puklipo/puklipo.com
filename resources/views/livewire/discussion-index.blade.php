<div>
    @auth
        <livewire:discussion-create></livewire:discussion-create>
    @endauth

    @include('discussions.nav')

    <div class="mx-3 px-3" x-data @page-updated.window="$el.scrollIntoView({behavior: 'smooth'})">
        @forelse($this->discussions as $discussion)
            @include('discussions.discussion')
        @empty
            質問はありません。
        @endforelse

        <p>
            {{ $this->discussions->links() }}
        </p>
    </div>
</div>
