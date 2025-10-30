<?php

declare(strict_types=1);

namespace Heart\Provider\Domain\Actions;

use Heart\Provider\Domain\Entities\ProviderEntity;
use Heart\Provider\Domain\Repositories\ProviderRepository;

final readonly class GetProviderById
{
    public function __construct(private ProviderRepository $providerRepository) {}

    public function handle(string $provider, string $providerId): ProviderEntity
    {
        return $this->providerRepository->findByProvider($provider, $providerId);
    }
}
