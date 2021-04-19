<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

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
    protected $guarded = [];

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Send an HTTP POST request to the subscribers' URL.
     *
     * @param array $all
     * @return void
     */
    public function publish(array $all)
    {
        Http::post($this->url, [
            'topic' => $this->topic->name,
            'data' => (array) $all
        ]);
    }
}
