<?php

namespace He4rt\Badge\Actions;

use He4rt\Badge\Contracts\BadgeRepository;

class DeleteBadge
{
    public function __construct(private readonly BadgeRepository $badgeRepository)
    {
    }

    public function handle(string $badgeId): void
    {
        $this->badgeRepository->delete($badgeId);
    }
}