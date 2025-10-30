<?php

declare(strict_types=1);

namespace Heart\Provider\Domain\ValueObjects;

final readonly class ProviderData
{
    public function __construct(
        private string $provider,
        private string $providerId
    ) {}

    public function getProviderId(): string
    {
        return $this->providerId;
    }

    public function getProvider(): string
    {
        return $this->provider;
    }
}
