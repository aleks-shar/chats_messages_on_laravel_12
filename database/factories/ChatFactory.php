<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Chat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Chat>
 */
final class ChatFactory extends Factory
{
    protected $model = Chat::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'last_message_at' => null,
            'last_message_text' => null,
        ];
    }
}
