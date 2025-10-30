<?php

declare(strict_types=1);

namespace He4rt\Badge\Actions;

use He4rt\Badge\DTOs\NewBadgeDTO;
use He4rt\Badge\Entities\BadgeEntity;

final readonly class CreateBadge
{
    public function __construct(private PersistBadge $persistBadge) {}

    public function handle(array $payload): BadgeEntity
    {
        $newBadgeDTO = NewBadgeDTO::make($payload);

        return $this->persistBadge->handle($newBadgeDTO);
    }
}
