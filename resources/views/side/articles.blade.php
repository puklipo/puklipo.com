<div class="p-3 text-sm text-gray-700 dark:text-white bg-gray-50 dark:bg-gray-700">
    <h2 class="text-lg text-gray-900 dark:text-white leading-7 font-bold">Articles</h2>

    <div class="ml-1 text-sm prose prose-indigo max-w-none">
        <ul>
            @foreach(config('articles') as $article)
                <li><a href="{{ Arr::get($article, 'url') }}" target="_blank" class="no-underline hover:underline">{{ Arr::get($article, 'title') }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
