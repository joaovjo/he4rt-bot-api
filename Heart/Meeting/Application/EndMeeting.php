<?php

declare(strict_types=1);

namespace Heart\Meeting\Application;

use Heart\Meeting\Domain\Actions\FinishMeeting;
use Illuminate\Support\Facades\Cache;

final readonly class EndMeeting
{
    public function __construct(private FinishMeeting $finishMeeting) {}

    public function handle(): void
    {
        $this->finishMeeting->handle(
            $this->getAndClearMeetingId()
        );
    }

    public function getAndClearMeetingId(): string
    {
        $meetingId = Cache::tags(['meetings'])->get('current-meeting');
        $this->clearMeetingCache();

        return $meetingId;
    }

    public function clearMeetingCache(): void
    {
        Cache::tags(['meetings'])->flush();
    }
}
