<?php

declare(strict_types=1);

namespace Tests\Unit\Meeting;

use Heart\Meeting\Domain\Entities\MeetingTypeEntity;
use Illuminate\Support\Facades\Date;

trait MeetingTypeProviderTrait
{
    public function validMeetingPayload(array $fields = []): array
    {
        return [
            'id' => 12,
            'name' => 'canhassi',
            'week_day' => 1,
            'start_at' => Date::now(),
        ];
    }

    public function validMeetingTypeEntity(): MeetingTypeEntity
    {
        return MeetingTypeEntity::make($this->validMeetingPayload());
    }
}
