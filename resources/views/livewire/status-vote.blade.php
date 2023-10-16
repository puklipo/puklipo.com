<div>
    <x-secondary-button wire:click="up">正しい {{ cache()->get('status:up:'.$status->id, 0) }}</x-secondary-button>
    <x-secondary-button wire:click="down">間違い {{ cache()->get('status:down:'.$status->id, 0) }}</x-secondary-button>
</div>
