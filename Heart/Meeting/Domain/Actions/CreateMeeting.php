<?php

declare(strict_types=1);

namespace Heart\Meeting\Domain\Actions;

use Heart\Meeting\Domain\DTO\NewMeetingDTO;
use Heart\Meeting\Domain\Entities\MeetingEntity;
use Heart\Meeting\Domain\Repositories\MeetingRepository;

final readonly class CreateMeeting
{
    public function __construct(private MeetingRepository $repository) {}

    public function handle(NewMeetingDTO $dto, string $adminId): MeetingEntity
    {
        return $this->repository->create($dto, $adminId);
    }
}
