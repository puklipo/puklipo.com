<div>
    <h3 class="ml-3">最近の公開質問</h3>
    <ul>
        @foreach($discussions as $discussion)
            <li>
                <a href="{{ route('discussion.show', $discussion) }}" class="no-underline hover:underline"> {{ $discussion->title }} [{{ $discussion->answers_count }}]</a>
            </li>
        @endforeach
    </ul>
</div>
