<header class="p-6 bg-white dark:bg-gray-800">
    <h1><a href="{{ route('home') }}" class="no-underline" wire:navigate>{{ config('app.name') }}</a></h1>

    <div></div>

    <div class="mt-3 flex flex-row gap-2">
        <a href="https://github.com/puklipo" class="text-gray-600 dark:text-white no-underline inline-flex" title="GitHub" target="_blank">
            <x-icon.github/>
        </a>
        <a href="{{ url('feed') }}" class="text-gray-600 dark:text-white no-underline inline-flex" title="RSS/Feed" target="_blank">
            <x-icon.rss/>
        </a>
    </div>
</header>
