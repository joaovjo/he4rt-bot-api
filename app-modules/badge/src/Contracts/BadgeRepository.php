<?php

declare(strict_types=1);

namespace He4rt\Badge\Contracts;

use He4rt\Badge\DTOs\NewBadgeDTO;
use He4rt\Badge\Entities\BadgeEntity;

interface BadgeRepository
{
    public function create(NewBadgeDTO $badgeDTO): BadgeEntity;

    public function findBySlug(string $badgeSlug): BadgeEntity;

    public function delete(int $badgeId): void;
}
