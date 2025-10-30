<?php

declare(strict_types=1);

namespace Heart\Meeting\Application;

use Heart\Meeting\Domain\Actions\CreateMeeting;
use Heart\Meeting\Domain\Actions\FindMeetingType;
use Heart\Meeting\Domain\DTO\NewMeetingDTO;
use Heart\Meeting\Domain\Entities\MeetingEntity;
use Heart\Provider\Application\FindProvider;
use Heart\Shared\Application\TTL;
use Illuminate\Support\Facades\Cache;

final readonly class StartMeeting
{
    public function __construct(
        private CreateMeeting $createMeetingAction,
        private FindProvider $findProvider,
        private FindMeetingType $findMeetingType,
    ) {}

    public function handle(string $provider, string $providerId, int $meetingTypeId): MeetingEntity
    {
        $this->findMeetingType->handle($meetingTypeId);

        $meetingDTO = NewMeetingDTO::make($provider, $providerId, $meetingTypeId);
        $providerEntity = $this->findProvider->handle($provider, $providerId);
        $currentMeeting = $this->createMeetingAction->handle($meetingDTO, $providerEntity->userId);
        $this->setMeetingCache($currentMeeting);

        return $currentMeeting;
    }

    public function setMeetingCache(MeetingEntity $currentMeeting): void
    {
        Cache::tags(['meetings'])->put('current-meeting', $currentMeeting->id, TTL::fromHours(2));
    }
}
