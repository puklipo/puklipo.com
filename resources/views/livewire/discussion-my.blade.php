<div>
    @auth
        <livewire:discussion-create></livewire:discussion-create>
    @endauth

    @include('discussions.nav')

    <div class="mx-6 px-6" x-data @page-updated.window="$el.scrollIntoView({behavior: 'smooth'})">
        @foreach($this->discussions as $discussion)
            <div>
                <h2>
                    @if($discussion->private)
                        <x-icon.lock-closed class="inline-flex"></x-icon.lock-closed>
                    @endif
                    [{{ $discussion->version }}]
                    <a href="{{ route('discussion.show', $discussion) }}"
                       class="no-underline hover:underline">{{ $discussion->title }}</a>
                </h2>
                <div>
                    回答 {{ $discussion->answers_count }}
                </div>
                <div>
                    <span class="font-bold">{{ $discussion->user->name ?? '匿名' }}</span>
                    <time class="text-gray-400">{{ $discussion->created_at }}</time>
                </div>

            </div>
        @endforeach

        <p>
            {{ $this->discussions->links() }}
        </p>
    </div>
</div>
