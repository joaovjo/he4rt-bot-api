<?php

namespace He4rt\Badge\Contracts;

use He4rt\Badge\DTOs\NewBadgeDTO;
use He4rt\Badge\Entities\BadgeEntity;

interface BadgeRepository
{
    public function create(NewBadgeDTO $badgeDTO): BadgeEntity;

    public function findBySlug(string $badgeSlug): BadgeEntity;

    public function delete(string $badgeId): void;
}