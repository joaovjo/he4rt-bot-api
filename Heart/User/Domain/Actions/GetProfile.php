<?php

declare(strict_types=1);

namespace Heart\User\Domain\Actions;

use Heart\User\Domain\Entities\ProfileEntity;
use Heart\User\Domain\Repositories\UserRepository;

final readonly class GetProfile
{
    public function __construct(private UserRepository $userRepository) {}

    public function handle(string $userId): ProfileEntity
    {
        return $this->userRepository->findProfile($userId);
    }
}
