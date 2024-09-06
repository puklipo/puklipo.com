<div
    class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md shadow-sm  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
    <div>
        <x-secondary-button wire:click="up">
            <x-icon.up class="mr-1"></x-icon.up>
            正しい {{ cache()->get('status:up:'.$status->id, 0) }}</x-secondary-button>
        <x-secondary-button wire:click="down">
            <x-icon.down class="mr-1"></x-icon.down>
            間違い {{ cache()->get('status:down:'.$status->id, 0) }}</x-secondary-button>
    </div>

    @if(request()->routeIs('status.show'))
        <div class="mt-3 text-sm text-gray-700 dark:text-gray-300 tracking-widest">
            Laravel Tips botの投稿は基本的にOpenAI APIの出力です。現在はLaravel関連リリースノートの日本語訳が主。
        </div>
    @endif

</div>
