<div class="p-3 border-b border-gray-200 dark:border-gray-500 hover:bg-indigo-50 dark:hover:bg-gray-800" wire:key="status-{{ $status->id }}">
    <div class="flex justify-between">
        <div class="font-extrabold text-lg inline-flex items-center">
            {{ $status->user->name }}
            @if($status->user->id === config('puklipo.users.admin'))
                <x-icon.check class="ml-1 text-indigo-500"/>
            @endif
        </div>
        <time title="{{ $status->created_at }}">
            <a href="{{ route('status.show', $status) }}"
               class="no-underline text-gray-500" wire:navigate>
                {{ $status->created_at->diffForHumans() }}
            </a>
        </time>
    </div>

    <div class="break-all px-3">
        @if(filled($status->title))
            <h2>{{ $status->title }}</h2>
        @endif

        <livewire:status-audio :$status wire:key="audio-{{ $status->id }}"></livewire:status-audio>

        <div>{{ \App\Support\Markdown::parse($status->content) }}</div>

        @if($status->user->id === config('puklipo.users.tips'))
            <livewire:status-vote :$status wire:key="vote-{{ $status->id }}"></livewire:status-vote>
        @endif
    </div>

    @can('admin')
        <livewire:status-trans :$status wire:key="trans-{{ $status->id }}"/>

        <div class="flex justify-end">
            <a href="{{ route('status.edit', $status) }}"
               class="p-1 no-underline hover:bg-indigo-100 hover:rounded-full" wire:navigate>
                <x-icon.three-dot/>
            </a>
        </div>
    @endcan

    <x-json-ld.status :$status />
</div>

