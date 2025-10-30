<?php

declare(strict_types=1);

namespace Tests\Unit\Meeting\Domain\Actions;

use Heart\Meeting\Domain\Actions\PaginateMeetings;
use Heart\Meeting\Domain\Entities\MeetingEntity;
use Heart\Meeting\Domain\Repositories\MeetingRepository;
use Heart\Shared\Domain\Paginator;
use Mockery as m;
use Mockery\MockInterface;
use Tests\TestCase;
use Tests\Unit\Meeting\MeetingProviderTrait;

final class PaginateMeetingsTest extends TestCase
{
    use MeetingProviderTrait;
    private MockInterface $meetingRepositoryStub;

    private MeetingEntity $meetingEntity;

    private Paginator $paginatorStub;

    protected function setUp(): void
    {
        parent::setUp();
        $this->meetingRepositoryStub = m::mock(MeetingRepository::class);
        $this->meetingEntity = $this->validMeetingEntity();
        $this->paginatorStub = m::mock(Paginator::class);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        m::close();
    }

    public function test_paginate_meetings(): void
    {
        $this->meetingRepositoryStub
            ->shouldReceive('paginate')
            ->with(['meetingType'])
            ->once()
            ->andReturn($this->paginatorStub);

        $test = new PaginateMeetings($this->meetingRepositoryStub);

        $test->handle();
    }
}
