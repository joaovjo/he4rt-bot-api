<?php

declare(strict_types=1);

namespace Heart\Provider\Domain\Entities;

use Heart\Provider\Domain\ValueObjects\ProviderData;

final readonly class ProviderEntity
{
    public ProviderData $provider;

    public function __construct(
        public string $id,
        public string $userId,
        string $provider,
        string $providerId,
        ?string $providerEmail
    ) {
        $this->provider = new ProviderData($provider, $providerId, $providerEmail);
    }

    public static function make(array $payload): self
    {
        return new self(
            $payload['id'],
            $payload['user_id'],
            $payload['provider'],
            $payload['provider_id'],
            $payload['email'] ?? null,
        );
    }
}
