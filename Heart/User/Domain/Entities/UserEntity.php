<?php

declare(strict_types=1);

namespace Heart\User\Domain\Entities;

use Exception;
use Heart\User\Domain\Exceptions\UserEntityException;
use Heart\User\Domain\ValueObjects\UserName;

final readonly class UserEntity
{
    public function __construct(
        public string $id,
        public UserName $name,
        public bool $isDonator,
    ) {}

    /** @throws UserEntityException */
    public static function make(array $payload): self
    {
        try {
            return new self(
                id: $payload['id'],
                name: $payload['username'],
                isDonator: $payload['isDonator']
            );
        } catch (Exception) {
            throw UserEntityException::failedToCreateEntity();
        }
    }

    /** @throws UserEntityException */
    public static function fromArray(array $user): self
    {
        return new self(
            id: $user['id'],
            name: new UserName($user['username']),
            isDonator: $user['is_donator']
        );
    }
}
