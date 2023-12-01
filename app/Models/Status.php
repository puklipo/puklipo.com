<?php

namespace App\Models;

use App\Support\IndexNow;
use App\Support\Markdown;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

use function Illuminate\Events\queueable;

/**
 * @mixin IdeHelperStatus
 */
class Status extends Model implements Feedable
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'content',
        'title',
        'twitter',
        'nostr_id',
        'created_at',
    ];

    protected static function booted(): void
    {
        static::created(queueable(function (Status $status) {
            info('IndexNow: '.IndexNow::submit(route('status.show', $status)));
        }));

        static::updated(queueable(function (Status $status) {
            info('IndexNow: '.IndexNow::submit(route('status.show', $status)));
        }));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create([
            'id' => $this->id,
            'title' => $this->title ?? $this->created_at,
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
