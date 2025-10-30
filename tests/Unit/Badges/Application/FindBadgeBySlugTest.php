<?php

declare(strict_types=1);

namespace Tests\Unit\Badges\Application;

use Heart\Badges\Application\FindBadgeBySlug;
use Heart\Badges\Domain\Entities\BadgeEntity;
use Heart\Badges\Domain\Repositories\BadgeRepository;
use Mockery as m;
use Mockery\MockInterface;
use Tests\TestCase;
use Tests\Unit\Badges\BadgeProviderTrait;

final class FindBadgeBySlugTest extends TestCase
{
    use BadgeProviderTrait;

    private MockInterface $badgeRepositoryStub;

    private BadgeEntity $badgeEntity;

    protected function setUp(): void
    {
        parent::setUp();
        $this->badgeRepositoryStub = m::mock(BadgeRepository::class);
        $this->badgeEntity = $this->validBadgeEntity();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        m::close();
    }

    public function test_find_badge_by_slug(): void
    {
        $slug = 'é-o-canhas';
        $this->badgeRepositoryStub
            ->shouldReceive('findBySlug')
            ->with($slug)
            ->once()
            ->andReturn($this->badgeEntity);

        $test = new FindBadgeBySlug($this->badgeRepositoryStub);

        $test->handle($slug);
    }
}
