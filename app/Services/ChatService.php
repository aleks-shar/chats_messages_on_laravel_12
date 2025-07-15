<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Chat;
use Illuminate\Contracts\Pagination\Paginator;

final class ChatService
{
    /**
     * @return Paginator<int, Chat>
     */
    public function getChatsWithMessages(): Paginator
    {
        return Chat::withLastMessage()
            ->select([
                'id',
                'name',
                'description',
                'last_message_at',
                'last_message_text',
                'created_at',
                'updated_at'
            ])
            ->simplePaginate(20);
    }
}
