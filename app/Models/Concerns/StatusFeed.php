<?php

namespace App\Models\Concerns;

use App\Support\Markdown;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Spatie\Feed\FeedItem;

trait StatusFeed
{
    public function toFeedItem(): FeedItem
    {
        $item = FeedItem::create()
            ->id($this->id)
            ->title($this->headline)
            ->summary(Markdown::parse($this->content))
            ->updated($this->updated_at)
            ->link(route('status.show', $this))
            ->authorName($this->user->name);

        if ($this->attachment?->exists) {
            $item->enclosure(Storage::url($this->attachment->file))
                ->enclosureLength($this->attachment->length)
                ->enclosureType($this->attachment->type);
        }

        return $item;
    }

    public function getFeedItems(): Collection
    {
        return static::latest()
            ->take(20)
            ->get();
    }
}
