<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_id')->constrained()->onDelete('cascade');
            $table->text('content');
            $table->timestamp('sent_at');
            $table->timestamps();

            $table->index(['chat_id', 'sent_at']);
            $table->index('chat_id');
            $table->index(['chat_id', 'sent_at', 'id'], 'idx_messages_chat_latest');
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
