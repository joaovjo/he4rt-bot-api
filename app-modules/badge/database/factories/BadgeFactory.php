<?php

namespace He4rt\Badge\Database\Factories;

use He4rt\Badge\Models\Badge;
use Illuminate\Database\Eloquent\Factories\Factory;

class BadgeFactory extends Factory
{
    protected $model = Badge::class;

    public function definition(): array
    {
        return [
            'provider' => 'default',
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'image_url' => $this->faker->imageUrl(),
            'redeem_code' => $this->faker->slug(2),
            'active' => true,
        ];
    }
}