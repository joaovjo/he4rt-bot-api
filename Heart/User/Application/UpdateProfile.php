<?php

declare(strict_types=1);

namespace Heart\User\Application;

use Heart\User\Domain\Repositories\UserRepository;

final readonly class UpdateProfile
{
    public function __construct(
        private FindProfile $findProfile,
        private UserRepository $userRepository
    ) {}

    public function handle(string $value, array $payload): void
    {

        $profileEntity = $this->findProfile->handle($value);
        $profileEntity->informationEntity->update($payload['info']);

        $this->userRepository->updateProfile($profileEntity);
    }
}
