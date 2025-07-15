<?php

declare(strict_types=1);

use App\Http\Controllers\Api\ChatController;
use Illuminate\Support\Facades\Route;

Route::prefix('chats')->group(function () {
    Route::get('/', [ChatController::class, 'index'])->name('chats.index');
    Route::get('/{chat}', [ChatController::class, 'show'])->name('chats.show');
});
