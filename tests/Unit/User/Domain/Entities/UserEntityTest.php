<?php

declare(strict_types=1);

namespace Tests\Unit\User\Domain\Entities;

use Heart\User\Domain\Entities\UserEntity;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

final class UserEntityTest extends TestCase
{
    public static function validUserPayloads(): array
    {
        return [
            [[
                'id' => 123,
                'name' => 'Luis Alberto Suárez',
                'username' => 'brabo3k',
                'is_donator' => true,
            ]],
            [[
                'id' => 1,
                'name' => 'Diego Souza',
                'username' => 'brabo4k',
                'is_donator' => false,
            ]],
        ];
    }

    #[DataProvider('validUserPayloads')]
    public function test_can_create_entity(array $userPayload): void
    {
        $user = UserEntity::fromArray($userPayload);

        $this->assertInstanceOf(UserEntity::class, $user);
    }
}
