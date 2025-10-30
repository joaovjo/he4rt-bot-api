<?php

declare(strict_types=1);

namespace Tests\Unit\Character\Application;

use Heart\Character\Application\FindCharacterIdByUserId;
use Heart\Character\Domain\Actions\GetCharacterByUserId;
use Heart\Character\Domain\Entities\CharacterEntity;
use Mockery as m;
use Mockery\MockInterface;
use Tests\TestCase;
use Tests\Unit\Character\CharacterProviderTrait;

final class FindCharacterIdByUserIdTest extends TestCase
{
    use CharacterProviderTrait;

    private MockInterface $getCharacterIdByUserId;

    private CharacterEntity $characterEntity;

    protected function setUp(): void
    {
        parent::setUp();
        $this->getCharacterIdByUserId = m::mock(GetCharacterByUserId::class);
        $this->characterEntity = $this->validCharacterEntity();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        m::close();
    }

    public function test_find_character_by_user_id(): void
    {
        $this->getCharacterIdByUserId
            ->shouldReceive('handle')
            ->with('canhassi-id')
            ->once()
            ->andReturn($this->characterEntity);

        $test = new FindCharacterIdByUserId($this->getCharacterIdByUserId);

        $test->handle('canhassi-id');
    }
}
