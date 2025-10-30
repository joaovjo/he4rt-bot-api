<?php

declare(strict_types=1);

namespace He4rt\Badge\Actions;

use He4rt\Badge\Contracts\BadgeRepository;
use He4rt\Badge\Entities\BadgeEntity;

final readonly class FindBadgeBySlug
{
    public function __construct(private BadgeRepository $badgeRepository) {}

    public function handle(string $badgeSlug): BadgeEntity
    {
        return $this->badgeRepository->findBySlug($badgeSlug);
    }
}
