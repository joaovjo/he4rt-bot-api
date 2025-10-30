<?php

declare(strict_types=1);

namespace Tests\Unit\Character\Domain\Actions;

use Heart\Character\Domain\Actions\PersistDailyBonus;
use Heart\Character\Domain\Exceptions\CharacterException;
use Heart\Character\Domain\Repositories\CharacterRepository;
use Illuminate\Support\Facades\Date;
use Mockery as m;
use Mockery\MockInterface;
use Tests\TestCase;
use Tests\Unit\Character\CharacterProviderTrait;

final class PersistDailyBonusTest extends TestCase
{
    use CharacterProviderTrait;

    private MockInterface $characterRepository;

    private PersistDailyBonus $action;

    protected function setUp(): void
    {
        parent::setUp();
        $this->characterRepository = m::mock(CharacterRepository::class);
        $this->action = new PersistDailyBonus($this->characterRepository);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        m::close();
    }

    public function test_can_claim(): void
    {
        $characterId = '123';
        Date::setTestNow(now()->subMinute());
        $characterEntity = $this->validCharacterEntity();
        Date::setTestNow(now()->addDay()->addMinute());

        $this->characterRepository
            ->shouldReceive('findById')
            ->with($characterId)
            ->once()
            ->andReturn($characterEntity);

        $this->characterRepository
            ->shouldReceive('claimDailyBonus')
            ->with($characterEntity)
            ->once();

        $this->action->handle($characterId);
    }

    public function test_should_not_claim(): void
    {
        $this->expectException(CharacterException::class);

        $characterId = '123';
        $characterEntity = $this->validCharacterEntity();

        $this->characterRepository
            ->shouldReceive('findById')
            ->with($characterId)
            ->once()
            ->andReturn($characterEntity);

        $this->action->handle($characterId);
    }
}
