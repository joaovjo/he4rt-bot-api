<?php

declare(strict_types=1);

namespace Tests\Unit\Character\Domain\Actions;

use Heart\Character\Domain\Actions\FindCharacter;
use Heart\Character\Domain\Entities\CharacterEntity;
use Heart\Character\Domain\Repositories\CharacterRepository;
use Mockery as m;
use Mockery\MockInterface;
use Tests\TestCase;
use Tests\Unit\Character\CharacterProviderTrait;

final class FindCharacterTest extends TestCase
{
    use CharacterProviderTrait;

    private MockInterface $characterRepositoryStub;

    private CharacterEntity $characterEntity;

    private MockInterface $findCharacterStub;

    protected function setUp(): void
    {
        parent::setUp();
        $this->characterRepositoryStub = m::mock(CharacterRepository::class);
        $this->characterEntity = $this->validCharacterEntity();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        m::close();
    }

    public function test_find_character_success(): void
    {
        $this->characterRepositoryStub
            ->shouldReceive('findById')
            ->with($this->characterEntity->id)
            ->once()
            ->andReturn($this->characterEntity);

        $test = new FindCharacter($this->characterRepositoryStub);

        $test->handle($this->characterEntity->id);
    }
}
