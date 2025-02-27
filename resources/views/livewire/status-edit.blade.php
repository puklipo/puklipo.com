<div class="p-3">
    <form wire:submit="update">
        @csrf

        <div>
            <x-input-label for="title" :value="__('タイトル')" class="hidden"/>
            <x-text-input id="title" name="title" title="タイトル"
                          class="block mt-1 w-full"
                          rows="3" :value="old('title')"
                          wire:model.live="title"
                          wire:ignore></x-text-input>

            <x-input-error :messages="$errors->get('title')" class="mt-2"/>
        </div>

        <div>
            <x-input-label for="content" :value="__('メッセージ')" class="hidden"/>
            <x-textarea id="content" name="content" title="メッセージ"
                        class="block mt-1 w-full"
                        rows="5"
                        wire:model.live="content"
                        wire:ignore
                        required autofocus>{{ old('content') }}</x-textarea>

            <x-input-error :messages="$errors->get('content')" class="mt-2"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4 px-6" title="{{ __('更新') }}" :disabled="blank($content)">
                {{ __('更新') }}
            </x-primary-button>
        </div>

        @if(filled($content))
            <div class="px-3 mt-4 break-all border rounded-md shadow-xs dark:border-gray-700">
                <h4 class="font-bold text-gray-400">プレビュー</h4>
                <h3 class="p-1">{{ $title }}</h3>
                <div class="p-1">{{ \App\Support\Markdown::parse($content) }}</div>
            </div>
        @endif
    </form>

    @can('admin')
        <div class="flex justify-end mt-6">
            <details>
                <summary class="text-gray-400 text-xs"></summary>
                <x-danger-button
                    wire:click="delete"
                    wire:confirm="削除しますか？"
                >削除
                </x-danger-button>
            </details>
        </div>
    @endcan
</div>
