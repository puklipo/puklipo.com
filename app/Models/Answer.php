<?php

namespace App\Models;

use App\Support\IndexNow;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use function Illuminate\Events\queueable;

/**
 * @mixin IdeHelperAnswer
 */
class Answer extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'content',
        'user_id',
    ];

    protected static function booted(): void
    {
        static::created(queueable(function (Answer $answer) {
            IndexNow::submit(route('discussion.show', $answer->discussion));
        }));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function discussion(): BelongsTo
    {
        return $this->belongsTo(Discussion::class);
    }
}
