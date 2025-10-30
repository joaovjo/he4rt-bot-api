<?php

declare(strict_types=1);

namespace Tests\Feature\Badge;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

final class CreateBadgeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_badge(): void
    {
        $payload = [
            'provider' => 'twitch',
            'name' => 'Aula foda',
            'description' => 'aula foda do dia foda',
            'image_url' => 'https://http.cat/200',
            'redeem_code' => '123',
            'active' => true,
        ];
        $this->actingAsAdmin()
            ->postJson(route('badges.store'), $payload)
            ->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('badges', $payload);
    }
}
