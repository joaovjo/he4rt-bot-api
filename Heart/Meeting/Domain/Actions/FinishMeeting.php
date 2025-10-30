<?php

declare(strict_types=1);

namespace Heart\Meeting\Domain\Actions;

use Heart\Meeting\Domain\Entities\MeetingEntity;
use Heart\Meeting\Domain\Repositories\MeetingRepository;

final readonly class FinishMeeting
{
    public function __construct(private MeetingRepository $meetingRepository) {}

    public function handle(string $meetingId): MeetingEntity
    {
        return $this->meetingRepository->endMeeting($meetingId);
    }
}
