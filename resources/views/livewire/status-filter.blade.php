<div class="p-3 text-white bg-indigo-400 dark:bg-gray-800 flex flex-row gap-2">
    <span class="font-bold text-sm">{{ __('フィルター') }}</span>

    @foreach($users as $user)
        <x-input-label class="text-white">
            <x-checkbox :checked="in_array($user->id, $filter)" wire:click="filterChange({{ $user->id }})"></x-checkbox>
            {{ $user->name }}
        </x-input-label>
    @endforeach
</div>
