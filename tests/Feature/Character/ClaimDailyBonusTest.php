<?php

declare(strict_types=1);

namespace Tests\Feature\Character;

use Heart\Character\Infrastructure\Models\Character;
use Heart\Provider\Infrastructure\Models\Provider;
use Heart\User\Infrastructure\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

final class ClaimDailyBonusTest extends TestCase
{
    use DatabaseTransactions;

    public function test_success(): void
    {
        $user = User::factory()
            ->has(Provider::factory(), 'providers')
            ->has(Character::factory(), 'character')
            ->create();

        $provider = $user->providers[0];
        $routeParams = [
            'provider' => $provider->provider,
            'providerId' => $provider->provider_id,
        ];
        $expected = $user->character->daily_bonus_claimed_at;
        $this->travelTo(now()->addHours(24)->addMinutes(2));
        $this
            ->actingAsAdmin()
            ->postJson(route('characters.dailyReward', $routeParams))
            ->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('characters', [
            'daily_bonus_claimed_at' => $expected,
        ]);
    }

    public function test_should_not_claim_before24_hours(): void
    {
        $user = User::factory()
            ->has(Provider::factory(), 'providers')
            ->has(Character::factory(), 'character')
            ->create();

        $provider = $user->providers[0];
        $routeParams = [
            'provider' => $provider->provider,
            'providerId' => $provider->provider_id,
        ];

        $this
            ->actingAsAdmin()
            ->postJson(route('characters.dailyReward', $routeParams))
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
