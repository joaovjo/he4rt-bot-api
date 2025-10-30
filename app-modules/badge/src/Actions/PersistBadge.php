<?php

namespace He4rt\Badge\Actions;

use He4rt\Badge\DTOs\NewBadgeDTO;
use He4rt\Badge\Entities\BadgeEntity;
use He4rt\Badge\Contracts\BadgeRepository;

class PersistBadge
{
    public function __construct(private readonly BadgeRepository $badgeRepository)
    {
    }

    public function handle(NewBadgeDTO $badgeDTO): BadgeEntity
    {
        return $this->badgeRepository->create($badgeDTO);
    }
}