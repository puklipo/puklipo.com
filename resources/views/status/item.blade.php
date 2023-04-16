<div class="p-3 border-t border-gray-200 dark:border-gray-500 hover:bg-indigo-50 dark:hover:bg-gray-800">
    <div class="flex justify-between">
        <div class="font-extrabold text-lg inline-flex items-center">
            {{ $status->user->name }}
        </div>
        <time title="{{ $status->created_at }}">
          {{ $status->created_at->diffForHumans() }}
        </time>
    </div>

    <div class="break-all">
        <div>{{ \App\Support\Markdown::parse($status->content) }}</div>
    </div>
</div>
