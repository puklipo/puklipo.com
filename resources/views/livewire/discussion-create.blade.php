
<div class="m-6 p-3 sm:p-6 bg-indigo-100 dark:bg-gray-800 border border-2 border-indigo-500 rounded-md">

    <form wire:submit="create">
        @csrf

        <div>
            <x-input-label for="version" :value="__('Laravelバージョン')" />
            <x-select name="version" id="version" wire:model.live="version">
                @foreach($versions as $ver)
                    <option value="{{ $ver }}" @if ($loop->first) selected @endif>{{ $ver }}</option>
                @endforeach
            </x-select>

            <x-input-error :messages="$errors->get('version')" class="mt-2"/>
        </div>

        <div>
            <x-input-label for="title" :value="__('タイトル')"/>
            <x-text-input id="title" name="title" title="タイトル"
                        class="block mt-1 w-full"
                        rows="3"
                        wire:model.live="title"
                        wire:ignore
                        required autofocus>{{ old('title') }}</x-text-input>

            <x-input-error :messages="$errors->get('title')" class="mt-2"/>
        </div>

        <div>
            <x-input-label for="content" :value="__('メッセージ(Markdown)')"/>
            <x-textarea id="content" name="content" title="メッセージ"
                        class="block mt-1 w-full"
                        rows="3"
                        wire:model.live="content"
                        wire:ignore
                        required>{{ old('content') }}</x-textarea>

            <x-input-error :messages="$errors->get('content')" class="mt-2"/>
        </div>

        <div>
            <x-input-label for="private" :value="__('非公開')"/>
            <x-checkbox name="private"
                        id="private"
                        class="checked:text-indigo-500"
                        wire:model.live="private"/>

            <x-input-error :messages="$errors->get('private')" class="mt-2"/>
        </div>


        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4 px-6" title="{{ __('送信') }}" :disabled="blank($content)">
                {{ __('送信') }}
            </x-primary-button>
        </div>

        @if(filled($content))
            <div class="px-3 mt-4 break-all border rounded-md shadow-sm dark:border-gray-700 bg-white dark:bg-gray-900">
                <h4 class="font-bold text-gray-400">プレビュー</h4>
                <div class="p-1">{{ \App\Support\Markdown::escape($content) }}</div>
            </div>
        @endif
    </form>
</div>
