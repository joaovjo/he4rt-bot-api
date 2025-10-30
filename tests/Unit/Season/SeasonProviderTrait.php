<?php

declare(strict_types=1);

namespace Tests\Unit\Season;

use Heart\Season\Domain\Entities\SeasonEntity;
use Illuminate\Support\Facades\Date;

trait SeasonProviderTrait
{
    public function validSeasonPayload(array $fields = []): array
    {
        return [
            'id' => 'canhassi-id',
            'name' => 'canhassi',
            'description' => 'é o canhas tropinha! famoso 3k',
            'messages_count' => 12121,
            'participants_count' => 1212,
            'meeting_count' => 12,
            'badges_count' => 12,
            'started_at' => Date::now()->toString(),
            'ended_at' => Date::now()->toString(),
            ...$fields,
        ];
    }

    public function validSeasonEntity(): SeasonEntity
    {
        return SeasonEntity::make($this->validSeasonPayload());
    }
}
