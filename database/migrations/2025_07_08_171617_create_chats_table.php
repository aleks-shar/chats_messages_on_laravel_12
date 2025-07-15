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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamp('last_message_at')->nullable();
            $table->text('last_message_text')->nullable();
            $table->timestamps();

            $table->index('last_message_at');
            $table->index(['last_message_at', 'id'], 'idx_chats_last_message_pagination');
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
