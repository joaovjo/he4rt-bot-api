<?php

declare(strict_types=1);

namespace Heart\Meeting\Domain\Actions;

use Heart\Meeting\Domain\Repositories\MeetingRepository;

final readonly class PersistAttendMeeting
{
    public function __construct(private MeetingRepository $meetingRepository) {}

    public function handle(string $meetingId, string $userId): void
    {
        $this->meetingRepository->attendMeeting($meetingId, $userId);
    }
}
