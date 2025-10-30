<?php

declare(strict_types=1);

namespace Tests\Unit\Badges\Domain\Actions;

use Heart\Badges\Domain\Actions\DeleteBadge;
use Heart\Badges\Domain\Entities\BadgeEntity;
use Heart\Badges\Domain\Repositories\BadgeRepository;
use Mockery as m;
use Mockery\MockInterface;
use Tests\TestCase;
use Tests\Unit\Badges\BadgeProviderTrait;

final class DeleteBadgeTest extends TestCase
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

    public function test_delete_badge_success(): void
    {
        $this->badgeRepositoryStub
            ->shouldReceive('delete')
            ->with($this->badgeEntity->id)
            ->once();

        $test = new DeleteBadge($this->badgeRepositoryStub);

        $test->handle($this->badgeEntity->id);
    }
}
