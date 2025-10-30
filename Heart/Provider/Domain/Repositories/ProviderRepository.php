<?php

declare(strict_types=1);

namespace Heart\Provider\Domain\Repositories;

use Heart\Provider\Domain\DTOs\NewProviderDTO;
use Heart\Provider\Domain\Entities\ProviderEntity;

interface ProviderRepository
{
    public function findByProvider(string $provider, string $providerId): ProviderEntity;

    public function findByProviderId(string $providerId): ?ProviderEntity;

    public function getProvider(string $provider, string $providerId): ?ProviderEntity;

    public function create(string $userId, NewProviderDTO $providerDTO): ProviderEntity;
}
