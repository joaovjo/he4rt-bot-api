<?php

declare(strict_types=1);

namespace Tests\Unit\Meeting\Domain\Actions;

use Heart\Meeting\Domain\Actions\FinishMeeting;
use Heart\Meeting\Domain\Entities\MeetingEntity;
use Heart\Meeting\Domain\Repositories\MeetingRepository;
use Mockery as m;
use Mockery\MockInterface;
use Tests\TestCase;
use Tests\Unit\Meeting\MeetingProviderTrait;

final class FinishMeetingTest extends TestCase
{
    use MeetingProviderTrait;
    private MockInterface $meetingRepositoryStub;

    private MeetingEntity $meetingEntity;

    protected function setUp(): void
    {
        parent::setUp();
        $this->meetingRepositoryStub = m::mock(MeetingRepository::class);
        $this->meetingEntity = $this->validMeetingEntity();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        m::close();
    }

    public function test_finish_meeting(): void
    {
        $this->meetingRepositoryStub
            ->shouldReceive('endMeeting')
            ->with($this->meetingEntity->id)
            ->once()
            ->andReturn($this->meetingEntity);

        $test = new FinishMeeting($this->meetingRepositoryStub);

        $test->handle($this->meetingEntity->id);
    }
}
