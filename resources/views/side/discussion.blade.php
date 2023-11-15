<div class="p-3 text-md text-white bg-indigo-400 dark:bg-gray-700">
    <h2><a href="{{ route('discussion') }}">Laravel専用相談所<span
                class="ml-1 px-1 text-indigo-500 bg-white rounded-sm">{{ cache()->remember('side.discussion.count', now()->addHour(), fn() => \App\Models\Discussion::onlyPublic()->count()) }}</span></a>
    </h2>
</div>
