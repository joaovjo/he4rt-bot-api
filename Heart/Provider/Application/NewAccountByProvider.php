<?php

declare(strict_types=1);

namespace Heart\Provider\Application;

use Heart\Provider\Domain\DTOs\NewProviderDTO;
use Heart\Provider\Domain\Entities\ProviderEntity;
use Heart\Provider\Domain\Enums\ProviderEnum;
use Heart\Provider\Domain\Repositories\ProviderRepository;
use Heart\User\Domain\Repositories\UserRepository;

final readonly class NewAccountByProvider
{
    public function __construct(
        private UserRepository $userRepository,
        private ProviderRepository $providerRepository,
    ) {}

    public function handle(ProviderEnum $providerEnum, string $providerId, string $username): ProviderEntity
    {
        $existentProvider = $this->providerRepository->getProvider($providerEnum->value, $providerId);

        if ($existentProvider instanceof ProviderEntity) {
            return $existentProvider;
        }

        $userEntity = $this->userRepository->createUser($username);

        return $this->providerRepository->create($userEntity->id, new NewProviderDTO(
            provider: $providerEnum,
            providerId: $providerId
        ));
    }
}
