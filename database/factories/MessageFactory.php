<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Message;
use App\Models\Chat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Message>
 */
final class MessageFactory extends Factory
{
    protected $model = Message::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'chat_id' => Chat::factory(),
            'content' => $this->faker->randomElement([
                $this->faker->sentence(),
                $this->faker->paragraph(),
                $this->faker->text(50),
                $this->faker->text(200),
                $this->faker->text(500),
            ]),
            'sent_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
