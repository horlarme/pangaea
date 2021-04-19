<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class Subscriber
 * @package App\Models
 * @property string $id
 * @property string $url
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Topic $topic
 *
 * @mixin Builder
 */
class Subscriber extends Model
{
    use HasFactory;

    public $incrementing = false;

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }
}
