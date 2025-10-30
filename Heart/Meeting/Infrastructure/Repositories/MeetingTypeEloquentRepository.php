<?php

declare(strict_types=1);

namespace Heart\Meeting\Infrastructure\Repositories;

use Heart\Meeting\Domain\Entities\MeetingTypeEntity;
use Heart\Meeting\Domain\Repositories\MeetingTypeRepository;
use Heart\Meeting\Infrastructure\Models\MeetingType;

final readonly class MeetingTypeEloquentRepository implements MeetingTypeRepository
{
    public function __construct(private MeetingType $model) {}

    public function findById(int $meetingTypeId): ?MeetingTypeEntity
    {
        /** @var MeetingType $model */
        $model = $this->model->find($meetingTypeId);

        if (! $model) {
            return null;
        }

        return MeetingTypeEntity::make($model->toArray());
    }
}
