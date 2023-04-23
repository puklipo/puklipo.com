<div class="p-3 text-sm text-gray-700 dark:text-white bg-gray-100 dark:bg-gray-800">
    <h2 class="text-lg text-gray-900 dark:text-white leading-7 font-bold">Zenn 技術書</h2>

    <div class="ml-1 text-sm prose prose-indigo max-w-none">
        <ul>
            @foreach(config('books') as $book)
                <li><a href="{{ Arr::get($book, 'url') }}" target="_blank" class="no-underline hover:underline">{{ Arr::get($book, 'title') }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
