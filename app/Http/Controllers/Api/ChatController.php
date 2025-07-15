<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChatResource;
use App\Models\Chat;
use App\Services\ChatService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class ChatController extends Controller
{
    /**
     * @param ChatService $service
     * @return AnonymousResourceCollection
     */
    public function index(ChatService $service): AnonymousResourceCollection
    {
        return ChatResource::collection($service->getChatsWithMessages());
    }

    /**
     * @param Chat $chat
     * @return ChatResource
     */
    public function show(Chat $chat): ChatResource
    {
        return new ChatResource($chat);
    }
}
