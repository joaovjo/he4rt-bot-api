<?php

namespace He4rt\Badge\Actions;

use He4rt\Badge\Actions\PersistBadge;
use He4rt\Badge\DTOs\NewBadgeDTO;
use He4rt\Badge\Entities\BadgeEntity;

class CreateBadge
{
    public function __construct(private readonly PersistBadge $persistBadge)
    {
    }

    public function handle(array $payload): BadgeEntity
    {
        $newBadgeDTO = NewBadgeDTO::make($payload);

        return $this->persistBadge->handle($newBadgeDTO);
    }
}