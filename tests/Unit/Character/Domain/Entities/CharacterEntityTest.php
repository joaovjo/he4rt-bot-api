<?php

declare(strict_types=1);

namespace Tests\Unit\Character\Domain\Entities;

use Heart\Character\Domain\Entities\CharacterEntity;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class CharacterEntityTest extends TestCase
{
    public static function characterProvider(): array
    {
        return [
            [1, 1, 1, 548, '2023-01-14 00:26:25', 4],
            [1, 1, 1, 89, '2023-01-14 00:26:25', 1],
            [1, 1, 1, 287, '2023-01-14 00:26:25', 3],
        ];
    }

    public static function makeCharacterProvider(): array
    {
        return [
            [['id' => 1, 'user_id' => 1, 'reputation' => 1, 'experience' => 548, 'daily_bonus_claimed_at' => '2023-01-14 00:26:25'], 4],
            [['id' => 1, 'user_id' => 1, 'reputation' => 1, 'experience' => 98, 'daily_bonus_claimed_at' => '2023-01-14 00:26:25'], 2],
        ];
    }

    #[DataProvider('characterProvider')]
    public function test_instance_character_entity_test(int $id, int $userId, int $reputation, int $experience, string $claimedAt, int $expectedLevel): void
    {
        $characterEntity = new CharacterEntity($id, $reputation, $userId, $experience, $claimedAt);

        self::assertEquals($expectedLevel, $characterEntity->getLevel());
        self::assertInstanceOf(CharacterEntity::class, $characterEntity);
    }

    #[DataProvider('makeCharacterProvider')]
    public function test_make_character(array $payload, int $expectedLevel): void
    {
        $characterEntity = CharacterEntity::make($payload);

        self::assertEquals($expectedLevel, $characterEntity->getLevel());
        self::assertInstanceOf(CharacterEntity::class, $characterEntity);
    }
}
