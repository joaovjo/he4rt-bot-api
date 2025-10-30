<?php

declare(strict_types=1);

namespace Heart\Character\Infrastructure\Factories;

use Illuminate\Database\Eloquent\Model;
use Heart\Character\Infrastructure\Models\Character;
use Heart\Character\Infrastructure\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
final class WalletFactory extends Factory
{
    protected $model = Wallet::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'character_id' => Character::factory(),
            'balance' => $this->faker->randomNumber(1, 99999),
        ];
    }
}
