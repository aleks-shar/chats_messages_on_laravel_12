<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\ChatFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property ?string $description
 * @property ?Carbon $last_message_at
 * @property ?string $last_message_text
 * @property string $last_message_preview
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method static Builder<Chat> withLastMessage()
 * @method static void updateLastMessage(Message $message)
 */
class Chat extends Model
{
    /** @use HasFactory<ChatFactory> */
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'last_message_at',
        'last_message_text',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'last_message_at' => 'datetime',
    ];

    /**
     * @return HasMany<Message, $this>
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * @return Builder<Chat>
     */
    public function scopeWithLastMessage(Builder $query): Builder
    {
        return $query->orderBy('last_message_at', 'desc');
    }

    /**
     * @return string
     */
    public function getLastMessagePreviewAttribute(): string
    {
        if (! $this->last_message_text) {
            return '';
        }

        return mb_strlen($this->last_message_text) > 100
            ? mb_substr($this->last_message_text, 0, 100) . '...'
            : $this->last_message_text;
    }

    /**
     * @param Message $message
     * @return void
     */
    public function updateLastMessage(Message $message): void
    {
        $this->update([
            'last_message_at' => $message->sent_at,
            'last_message_text' => $message->content,
        ]);
    }
}
