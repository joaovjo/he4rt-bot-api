<?php

declare(strict_types=1);

namespace Heart\Meeting\Domain\Actions;

use Heart\Meeting\Domain\Entities\MeetingTypeEntity;
use Heart\Meeting\Domain\Exceptions\MeetingException;
use Heart\Meeting\Domain\Repositories\MeetingTypeRepository;

final readonly class FindMeetingType
{
    public function __construct(private MeetingTypeRepository $meetingTypeRepository) {}

    public function handle(int $meetingType): MeetingTypeEntity
    {
        $meetingTypeEntity = $this->meetingTypeRepository->findById($meetingType);

        throw_unless($meetingTypeEntity instanceof MeetingTypeEntity, MeetingException::meetingTypeNotFound());

        return $meetingTypeEntity;
    }
}
