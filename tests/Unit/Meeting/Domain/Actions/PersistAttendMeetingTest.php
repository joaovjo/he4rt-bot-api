<?php

declare(strict_types=1);

namespace Tests\Unit\Meeting\Domain\Actions;

use Heart\Meeting\Domain\Actions\PersistAttendMeeting;
use Heart\Meeting\Domain\DTO\NewMeetingDTO;
use Heart\Meeting\Domain\Entities\MeetingEntity;
use Heart\Meeting\Domain\Repositories\MeetingRepository;
use Mockery as m;
use Mockery\MockInterface;
use Tests\TestCase;
use Tests\Unit\Meeting\MeetingProviderTrait;

final class PersistAttendMeetingTest extends TestCase
{
    use MeetingProviderTrait;
    private MockInterface $meetingTypeRepositoryStub;

    private MeetingEntity $meetingEntity;

    private NewMeetingDTO $payloadDTO;

    protected function setUp(): void
    {
        parent::setUp();
        $this->meetingTypeRepositoryStub = m::mock(MeetingRepository::class);
        $this->meetingEntity = $this->validMeetingEntity();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        m::close();
    }

    public function test_persist_attend_meeting(): void
    {
        $this->meetingTypeRepositoryStub
            ->shouldReceive('attendMeeting')
            ->with($this->meetingEntity->id, 12)
            ->once();

        $test = new PersistAttendMeeting($this->meetingTypeRepositoryStub);

        $test->handle($this->meetingEntity->id, 12);
    }
}
