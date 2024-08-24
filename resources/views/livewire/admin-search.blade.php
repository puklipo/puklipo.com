<div>
    <div>
        <x-input-label for="search" :value="__('検索')"/>
        <x-text-input id="search" name="search" title="検索"
                      class="block mt-1 w-full"
                      wire:model.live="search"
        ></x-text-input>

        <x-input-error :messages="$errors->get('search')" class="mt-2"/>
    </div>

    <div class="prose prose-indigo dark:prose-invert prose-md max-w-none sm:col-span-2">
        @foreach($this->statuses as $status)
            @include('status.item')
        @endforeach

        <p>
            {{ $this->statuses->links() }}
        </p>
    </div>
</div>
