<?php

declare(strict_types=1);

namespace Heart\User\Application;

use Heart\User\Domain\Entities\UserEntity;
use Heart\User\Domain\Exceptions\UserEntityException;
use Heart\User\Domain\Repositories\UserRepository;

final readonly class GetUser
{
    public function __construct(private UserRepository $repository) {}

    /** @throws UserEntityException */
    public function handle(string $userId): UserEntity
    {
        return $this->repository->find($userId);
    }
}
