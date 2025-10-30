<?php

declare(strict_types=1);

namespace Heart\Character\Infrastructure\Factories;

use Illuminate\Database\Eloquent\Model;
use Heart\Character\Infrastructure\Models\Character;
use Heart\User\Infrastructure\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
final class CharacterFactory extends Factory
{
    protected $model = Character::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'user_id' => User::factory(),
            'reputation' => $this->faker->numberBetween(1, 10),
            'experience' => $this->faker->numberBetween(1, 5000),
            'daily_bonus_claimed_at' => now(),
        ];
    }
}
