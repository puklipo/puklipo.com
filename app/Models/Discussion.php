<?php

namespace App\Models;

use App\Casts\Headline;
use App\Support\IndexNow;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use function Illuminate\Events\queueable;

/**
 * @mixin IdeHelperDiscussion
 */
class Discussion extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'title',
        'content',
        'version',
        'private',
    ];

    protected $with = [
        'user',
    ];

    protected function casts(): array
    {
        return [
            'private' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::created(queueable(function (Discussion $discussion) {
            IndexNow::submit(route('discussion.show', $discussion));
        }));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function scopeOnlyPublic(Builder $query): void
    {
        $query->where('private', false);
    }

    public function scopeOnlyPrivate(Builder $query): void
    {
        $query->where('private', true);
    }
}
