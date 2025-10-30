<?php

declare(strict_types=1);

use Symfony\Component\HttpFoundation\Response;

test('can create badge', function (): void {
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
});
