<div>
    @auth
        <livewire:discussion-create></livewire:discussion-create>
    @endauth

    @include('discussions.nav')

    <div class="mx-3 px-3" id="discussion">
        @forelse($this->discussions as $discussion)
            @include('discussions.discussion')
        @empty
            質問はありません。
        @endforelse

        <p>
            {{ $this->discussions->links(data: ['scrollTo' => '#discussion']) }}
        </p>
    </div>
</div>
