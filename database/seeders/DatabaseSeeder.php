<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class DatabaseSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('messages')->truncate();
        DB::table('chats')->truncate();

        $chats = Chat::factory(100)->create();
        $this->command->info('Создано 100 чатов');

        $chats->each(function (Chat $chat, $index) {
            $messageCount = rand(10, 100);
            $messages = Message::factory($messageCount)
                ->create([
                    'chat_id' => $chat->id,
                    'sent_at' => function () {
                        return fake()->dateTimeBetween('-6 months', 'now');
                    }
                ]);
            $lastMessage = $messages->sortBy('sent_at')->last();

            if ($lastMessage) {
                $chat->update([
                    'last_message_at' => $lastMessage->sent_at,
                    'last_message_text' => $lastMessage->content,
                ]);
            }

            if (($index + 1) % 10 === 0) {
                $this->command->info("Обработано чатов: " . ($index + 1));
            }
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $this->command->info('Тестовые данные созданы успешно!');
    }
}
