<div class="p-3 text-sm text-gray-700 dark:text-white bg-gray-100 dark:bg-gray-800">
    <h3 class="text-lg text-gray-900 dark:text-white leading-7 font-bold">記事</h3>

    <div class="ml-1 text-sm prose prose-indigo max-w-none">
        <ul>
            @foreach(config('articles') as $article)
                <li><a href="{{ Arr::get($article, 'url') }}" target="_blank" class="no-underline hover:underline">{{ Arr::get($article, 'title') }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
