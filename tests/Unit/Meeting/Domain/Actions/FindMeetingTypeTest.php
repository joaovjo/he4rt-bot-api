<?php

declare(strict_types=1);

namespace Tests\Unit\Meeting\Domain\Actions;

use Heart\Meeting\Domain\Actions\FindMeetingType;
use Heart\Meeting\Domain\Entities\MeetingTypeEntity;
use Heart\Meeting\Domain\Exceptions\MeetingException;
use Heart\Meeting\Domain\Repositories\MeetingTypeRepository;
use Mockery as m;
use Mockery\MockInterface;
use Tests\TestCase;
use Tests\Unit\Meeting\MeetingTypeProviderTrait;

final class FindMeetingTypeTest extends TestCase
{
    use MeetingTypeProviderTrait;
    public $meetingEntity;

    private MockInterface $meetingTypeRepositoryStub;

    private MeetingTypeEntity $meetingTypeEntity;

    protected function setUp(): void
    {
        parent::setUp();
        $this->meetingTypeRepositoryStub = m::mock(MeetingTypeRepository::class);
        $this->meetingEntity = $this->validMeetingTypeEntity();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        m::close();
    }

    public function test_meeting_type_is_not_found(): void
    {
        $this->expectException(MeetingException::class);

        $this->meetingTypeRepositoryStub
            ->shouldReceive('findById')
            ->with(12)
            ->once()
            ->andReturn(null);

        $test = new FindMeetingType($this->meetingTypeRepositoryStub);

        $test->handle(12);
    }

    /**
     * @throws MeetingException
     */
    public function test_find_meeting_type_success(): void
    {
        $this->meetingTypeRepositoryStub
            ->shouldReceive('findById')
            ->with(2)
            ->once()
            ->andReturn($this->meetingEntity);

        $test = new FindMeetingType($this->meetingTypeRepositoryStub);

        $test->handle(2);
    }
}
