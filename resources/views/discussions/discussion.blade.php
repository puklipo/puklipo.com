<div>
    <h2>
        @if($discussion->private)
            <x-icon.lock-closed class="inline-flex"></x-icon.lock-closed>
        @endif
        <span class="font-normal">[{{ $discussion->version }}]</span>
        <a href="{{ route('discussion.show', $discussion) }}"
           class="no-underline hover:underline">{{ $discussion->title }}</a>
    </h2>
    <div>
        <span class="font-bold">{{ $discussion->user->name ?? '匿名' }}</span>
        <time class="text-gray-400" datetime="{{ $discussion->created_at }}" title="{{ $discussion->created_at }}">{{ $discussion->created_at->diffForHumans() }}</time>
    </div>
</div>
