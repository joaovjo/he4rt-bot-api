<?php

declare(strict_types=1);

namespace Tests\Unit\Character\Domain\Actions;

use Heart\Character\Domain\Actions\FindCharacter;
use Heart\Character\Domain\Actions\IncrementExperience;
use Heart\Character\Domain\Entities\CharacterEntity;
use Heart\Character\Domain\Repositories\CharacterRepository;
use Mockery as m;
use Mockery\MockInterface;
use Tests\TestCase;
use Tests\Unit\Character\CharacterProviderTrait;

final class IncrementExperienceTest extends TestCase
{
    use CharacterProviderTrait;

    private MockInterface $characterRepositoryStub;

    private CharacterEntity $characterEntity;

    private MockInterface $findCharacterStub;

    protected function setUp(): void
    {
        parent::setUp();
        $this->characterRepositoryStub = m::mock(CharacterRepository::class);
        $this->findCharacterStub = m::mock(FindCharacter::class);
        $this->characterEntity = $this->validCharacterEntity();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        m::close();
    }

    public function test_increment_experience_success(): void
    {
        $this->characterRepositoryStub
            ->shouldReceive('updateExperience')
            ->with($this->characterEntity)
            ->once()
            ->andReturn($this->characterEntity);

        $this->findCharacterStub
            ->shouldReceive('handle')
            ->with($this->characterEntity->id)
            ->once()
            ->andReturn($this->characterEntity);

        $test = new IncrementExperience($this->characterRepositoryStub, $this->findCharacterStub);

        $test->incrementByTextMessage($this->characterEntity->id, 'CONGRATS!!');
    }
}
