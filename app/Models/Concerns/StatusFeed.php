<?php

namespace App\Models\Concerns;

use App\Support\Markdown;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Feed\FeedItem;

trait StatusFeed
{
    public function toFeedItem(): FeedItem
    {
        return FeedItem::create([
            'id' => $this->id,
            'title' => empty($this->title) ? $this->created_at : $this->title,
            'summary' => Markdown::parse($this->content),
            'updated' => $this->updated_at,
            'link' => route('status.show', $this),
            'authorName' => $this->user->name,
        ]);
    }

    public function getFeedItems(): Collection
    {
        return static::with('user')
            ->where('user_id', config('puklipo.users.admin'))
            ->latest()
            ->take(20)
            ->get();
    }
}
