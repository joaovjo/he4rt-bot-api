<?php

declare(strict_types=1);

namespace Tests\Unit\Meeting\Domain\Actions;

use Heart\Meeting\Domain\Actions\CreateMeeting;
use Heart\Meeting\Domain\DTO\NewMeetingDTO;
use Heart\Meeting\Domain\Entities\MeetingEntity;
use Heart\Meeting\Domain\Repositories\MeetingRepository;
use Mockery as m;
use Mockery\MockInterface;
use Tests\TestCase;
use Tests\Unit\Meeting\MeetingProviderTrait;

final class CreateMeetingTest extends TestCase
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
        $this->payloadDTO = NewMeetingDTO::make(
            'discord',
            'canhassi',
            $this->meetingEntity->meetingTypeId
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        m::close();
    }

    public function test_create_meeting(): void
    {
        $this->meetingTypeRepositoryStub
            ->shouldReceive('create')
            ->with($this->payloadDTO, $this->meetingEntity->adminId)
            ->once()
            ->andReturn($this->meetingEntity);

        $test = new CreateMeeting($this->meetingTypeRepositoryStub);

        $test->handle($this->payloadDTO, $this->meetingEntity->adminId);
    }
}
