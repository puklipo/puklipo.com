@auth
    <div class="mx-6 px-6 grid grid-flow-col auto-cols-max gap-4">
        <span><a href="{{ route('discussion') }}">公開質問</a></span>
        <span><a href="{{ route('discussion.my') }}">自分の質問</a></span>
        @can('admin')
            <span><a href="{{ route('discussion.private') }}">非公開質問</a></span>
        @endcan
    </div>
@endauth
