<div class="p-3 text-sm text-gray-700 dark:text-white bg-gray-200 dark:bg-gray-700">
    <h2 class="text-lg text-gray-900 dark:text-white leading-7 font-bold">仕事メニュー</h2>

    <div class="mt-1">
        <div class="bg-white dark:bg-gray-800 dark:text-white border rounded my-2">
            <div class="p-2"><span class="font-bold mr-3">料金目安</span>月額20～100万円（税別）インボイス対応</div>
        </div>
    </div>

    <div class="divide-y">
        @includeIf('menu.develop')
        @includeIf('menu.laravel')
        @includeIf('menu.remote')
    </div>
</div>
