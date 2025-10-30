<?php

declare(strict_types=1);

namespace Tests\Feature\Providers;

use Heart\Provider\Infrastructure\Models\Provider;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

final class NewAccountByProviderTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_create_account_by_provider(): void
    {
        $provider = 'discord';
        $payload = [
            'provider_id' => '184789120940244992',
            'username' => 'danielhe4rt',
        ];

        $response = $this
            ->actingAsAdmin()
            ->postJson(route('providers.store', ['provider' => $provider]), $payload);

        $response->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseHas('users', [
            'username' => $payload['username'],
        ]);

        $this->assertDatabaseHas('providers', [
            'provider' => $provider,
            'provider_id' => $payload['provider_id'],
        ]);

        $this->assertDatabaseHas('characters', [
            'user_id' => $response['userId'],
        ]);
    }

    public function test_should_not_create_account_with_a_registered_provider(): void
    {
        $provider = Provider::factory()->create();

        $payload = [
            'provider_id' => $provider->provider_id,
            'username' => 'danielhe4rt',
        ];

        $response = $this
            ->actingAsAdmin()
            ->postJson(route('providers.store', ['provider' => $provider->provider]), $payload);

        $response->assertStatus(Response::HTTP_CREATED);

        $this->assertDatabaseMissing('users', [
            'username' => $payload['username'],
        ]);
    }
}
