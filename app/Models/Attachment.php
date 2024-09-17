<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperAttachment
 */
class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'type',
        'length',
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
}
