<?php

declare(strict_types=1);

namespace Tests\Unit\Season\Application;

use Heart\Season\Application\GetSeasons;
use Heart\Season\Domain\Collections\SeasonCollection;
use Heart\Season\Domain\Entities\SeasonEntity;
use Heart\Season\Domain\Repositories\SeasonRepository;
use Mockery as m;
use Mockery\MockInterface;
use Tests\TestCase;
use Tests\Unit\Season\SeasonProviderTrait;

final class GetSeasonsTest extends TestCase
{
    use SeasonProviderTrait;

    private MockInterface $seasonRepositoryStub;

    private SeasonEntity $seasonEntity;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seasonRepositoryStub = m::mock(SeasonRepository::class);
        $this->seasonEntity = $this->validSeasonEntity();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        m::close();
    }

    public function test_get_season_success(): void
    {
        $this->seasonRepositoryStub
            ->shouldReceive('getAll')
            ->once()
            ->andReturn(new SeasonCollection());

        $test = new GetSeasons($this->seasonRepositoryStub);

        $test->handle();
    }
}
