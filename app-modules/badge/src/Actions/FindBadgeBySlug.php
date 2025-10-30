<?php

namespace He4rt\Badge\Actions;

use He4rt\Badge\Entities\BadgeEntity;
use He4rt\Badge\Contracts\BadgeRepository;

class FindBadgeBySlug
{
    public function __construct(private readonly BadgeRepository $badgeRepository)
    {
    }

    public function handle(string $badgeSlug): BadgeEntity
    {
        return $this->badgeRepository->findBySlug($badgeSlug);
    }
}