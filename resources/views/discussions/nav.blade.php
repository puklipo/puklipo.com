@auth
    <div class="mx-3 px-3 text-center grid grid-flow-col auto-cols-max gap-4">
        <span><a href="{{ route('discussion') }}" @unless(request()->routeIs('discussion')) class="no-underline" @endunless>公開質問</a></span>
        <span><a href="{{ route('discussion.my') }}" @unless(request()->routeIs('discussion.my')) class="no-underline" @endunless>自分の質問</a></span>
        @can('admin')
            <span><a href="{{ route('discussion.private') }}"
                     @unless(request()->routeIs('discussion.private')) class="no-underline" @endunless>非公開質問</a></span>
        @endcan
    </div>
@endauth
