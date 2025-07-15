<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Message;

final class MessageObserver
{
    /**
     * @param Message $message
     * @return void
     */
    public function created(Message $message): void
    {
        $message->chat->updateLastMessage($message);
    }

    /**
     * @param Message $message
     * @return void
     */
    public function updated(Message $message): void
    {
        $latestMessage = $message->chat->messages()
            ->orderBy('sent_at', 'desc')
            ->first();

        if ($latestMessage instanceof Message && $latestMessage->id === $message->id) {
            $message->chat->updateLastMessage($message);
        }
    }
}
