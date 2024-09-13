<?php

namespace App\Models;

use App\Casts\Headline;
use App\Models\Concerns\StatusFeed;
use App\Notifications\StatusCreatedNotification;
use App\Support\IndexNow;
use App\Support\ThreadsToken;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Notification;
use Revolution\Bluesky\Notifications\BlueskyRoute;
use Spatie\Feed\Feedable;

use function Illuminate\Events\queueable;

/**
 * @mixin IdeHelperStatus
 */
class Status extends Model implements Feedable
{
    use HasFactory;
    use HasUlids;
    use StatusFeed;

    protected $fillable = [
        'content',
        'title',
        'twitter',
        'nostr_id',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'headline' => Headline::class,
        ];
    }

    protected static function booted(): void
    {
        static::created(queueable(function (Status $status) {
            IndexNow::submitIf(app()->isProduction(), route('status.show', $status));

            if (app()->isProduction()) {
                Notification::route('bluesky', BlueskyRoute::to(identifier: config('bluesky.identifier'), password: config('bluesky.password')))
                    ->route('threads', app(ThreadsToken::class)->get())
                    ->route('discord-webhook', config('services.discord.webhook'))
                    ->notify(new StatusCreatedNotification($status));
            }
        }));

        static::updated(queueable(function (Status $status) {
            IndexNow::submitIf(app()->isProduction(), route('status.show', $status));
        }));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
