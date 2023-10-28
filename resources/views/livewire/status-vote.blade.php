<div>
    <x-secondary-button wire:click="up"><x-icon.up class="mr-1"></x-icon.up> 正しい {{ cache()->get('status:up:'.$status->id, 0) }}</x-secondary-button>
    <x-secondary-button wire:click="down"><x-icon.down class="mr-1"></x-icon.down> 間違い {{ cache()->get('status:down:'.$status->id, 0) }}</x-secondary-button>
</div>
