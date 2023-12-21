<div class="mx-3 px-3 break-auto">
    <div>
        <h2 class="border-b-2 border-indigo-500">質問</h2>
        <h3 class="text-2xl">
            @if($discussion->private)
                <x-icon.lock-closed class="inline-flex"></x-icon.lock-closed>
            @endif
            <span class="font-normal">[{{ $discussion->version }}]</span>
            <a href="{{ route('discussion.show', $discussion) }}"
               class="no-underline hover:underline" wire:navigate>{{ $discussion->title }}</a>

        </h3>
        <div>
            {{ \App\Support\Markdown::escape($discussion->content) }}
        </div>
        <div>
            <span class="font-bold">{{ $discussion->user->name ?? '匿名' }}</span>
            <time class="text-gray-400" datetime="{{ $discussion->created_at }}"
                  title="{{ $discussion->created_at }}">{{ $discussion->created_at->diffForHumans() }}</time>
        </div>
        @can('admin')
            <div class="flex justify-end">
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

    <div>
        <h2 class="border-b-2 border-indigo-500">回答</h2>
        <div class="m-3 sm:m-6">
            @forelse($discussion->answers as $answer)
                <div class="border-b" wire:key="{{ $answer->id }}">
                    <div>{{ \App\Support\Markdown::escape($answer->content) }}</div>
                    <div>
                        <span class="font-bold inline-flex items-center">{{ $answer->user->name ?? '匿名' }}
                            @if($answer?->user?->id === config('puklipo.users.admin'))
                                <x-icon.check class="ml-1 text-indigo-500"/>
                            @endif
                        </span>
                        <time class="text-gray-400" datetime="{{ $answer->created_at }}"
                              title="{{ $answer->created_at }}">{{ $answer->created_at->diffForHumans() }}</time>
                    </div>
                    @can('admin')
                        <div class="flex justify-end">
                            <details>
                                <summary class="text-gray-400 text-xs"></summary>
                                <x-danger-button
                                    wire:click="deleteAnswer('{{ $answer->id }}')"
                                    wire:confirm="削除しますか？"
                                >削除
                                </x-danger-button>
                            </details>
                        </div>
                    @endcan
                </div>

            @empty
                回答はまだありません。
            @endforelse
        </div>
    </div>

    <livewire:answer-create :discussion="$discussion"/>
</div>
