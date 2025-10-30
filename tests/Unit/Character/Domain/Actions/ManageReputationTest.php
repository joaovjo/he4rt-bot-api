<?php

declare(strict_types=1);

namespace Tests\Unit\Character\Domain\Actions;

use Heart\Character\Domain\Actions\ManageReputation;
use Heart\Character\Domain\Actions\PersistDailyBonus;
use Heart\Character\Domain\Repositories\CharacterRepository;
use Mockery as m;
use Mockery\MockInterface;
use Tests\TestCase;
use Tests\Unit\Character\CharacterProviderTrait;

final class ManageReputationTest extends TestCase
{
    use CharacterProviderTrait;

    private ManageReputation $manageReputation;

    private MockInterface $characterRepository;

    private PersistDailyBonus $claimDailyBonus;

    protected function setUp(): void
    {
        parent::setUp();
        $this->characterRepository = m::mock(CharacterRepository::class);
        $this->manageReputation = new ManageReputation($this->characterRepository);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        m::close();
    }

    public function test_add_reputation(): void
    {
        $character = $this->validCharacterEntity();
        $characterId = 'porra-careca';

        $this->characterRepository
            ->shouldReceive('findById')
            ->once()
            ->with($characterId)
            ->andReturn($character);

        $this->characterRepository
            ->shouldReceive('updateReputation')
            ->once()
            ->with($character);

        $this->manageReputation->handle($characterId, 'increment');
    }
}
