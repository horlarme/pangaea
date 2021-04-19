<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * Class Topic
 * @package App\Models
 * @property string $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Subscriber[] $subscribers
 *
 * @mixin Builder
 */
class Topic extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $guarded = [];

    public function subscribers(): HasMany
    {
        return $this->hasMany(Subscriber::class);
    }
}
