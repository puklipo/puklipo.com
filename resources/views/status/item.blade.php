<div class="p-3 border-b border-gray-200 dark:border-gray-500 hover:bg-indigo-50 dark:hover:bg-gray-800">
    <div class="flex justify-between">
        <div class="font-extrabold text-lg inline-flex items-center">
            {{ $status->user->name }}
        </div>
        <time title="{{ $status->created_at }}">
            <a href="{{ route('status.show', $status) }}"
               class="no-underline text-gray-500">
                {{ $status->created_at->diffForHumans() }}
            </a>
        </time>
    </div>

    <div class="break-all p-1">
        <div>{{ \App\Support\Markdown::parse($status->content) }}</div>
    </div>
</div>
