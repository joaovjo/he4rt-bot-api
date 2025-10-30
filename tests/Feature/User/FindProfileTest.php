<?php

declare(strict_types=1);

namespace Tests\Feature\User;

use Heart\Badges\Infrastructure\Model\Badge;
use Heart\Character\Infrastructure\Models\Character;
use Heart\Character\Infrastructure\Models\PastSeason;
use Heart\Message\Infrastructure\Models\Message;
use Heart\Provider\Infrastructure\Models\Provider;
use Heart\User\Infrastructure\Models\Address;
use Heart\User\Infrastructure\Models\Information;
use Heart\User\Infrastructure\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

final class FindProfileTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_find_profile_with_username(): void
    {
        $user = User::factory()
            ->has(Character::factory()->has(PastSeason::factory()), 'character')
            ->has(Address::factory(), 'address')
            ->has(Information::factory(), 'information')
            ->has(Provider::factory()->has(Message::factory()->count(2)))
            ->create();
        //        $character->badges()->attach($badge->id, ['claimed_at' => now()]);

        $this
            ->actingAsAdmin()
            ->getJson(route('users.profile', ['value' => $user->username]))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'id',
                'username',
                'character' => [
                    'user_id',
                    'reputation',
                    'level',
                    'experience',
                    'daily_bonus_claimed_at',
                ],
                'connectedProviders' => [
                    0 => [
                        'provider',
                        'messages_count',
                    ],
                ],
                'badges',
                'address' => [
                    'country',
                ],
                'pastSeasons' => [
                    0 => [
                        'season_id',
                    ],
                ],
            ]);
    }

    public function test_can_find_profile_with_provider_id(): void
    {
        $user = User::factory()
            ->has(Character::factory()->has(PastSeason::factory()), 'character')
            ->has(Address::factory(), 'address')
            ->has(Information::factory(), 'information')
            ->has(Provider::factory()->has(Message::factory()->count(2)))
            ->create();
        $badge = Badge::factory()->create();

        $character = $user->character;
        $character->badges()->attach($badge->id, ['claimed_at' => now()]);

        $this
            ->actingAsAdmin()
            ->getJson(route('users.profile', ['value' => $user->providers[0]->provider_id]))
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'id',
                'username',
                'character' => [
                    'user_id',
                    'reputation',
                    'level',
                    'experience',
                    'daily_bonus_claimed_at',
                ],
                'connectedProviders' => [
                    0 => [
                        'provider',
                        'messages_count',
                    ],
                ],
                'badges',
                'address' => [
                    'country',
                ],
                'pastSeasons' => [
                    0 => [
                        'season_id',
                    ],
                ],
            ]);
    }
}
