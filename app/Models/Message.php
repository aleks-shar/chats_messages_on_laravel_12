<?php

declare(strict_types=1);

namespace App\Models;

use App\Observers\MessageObserver;
use Carbon\Carbon;
use Database\Factories\MessageFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $chat_id
 * @property string $content
 * @property Carbon $sent_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Chat $chat
 */
#[ObservedBy([MessageObserver::class])]
class Message extends Model
{
    /** @use HasFactory<MessageFactory> */
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'chat_id',
        'content',
        'sent_at',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'sent_at' => 'datetime',
    ];

    /**
     * @return BelongsTo<Chat, $this>
     */
    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }
}
