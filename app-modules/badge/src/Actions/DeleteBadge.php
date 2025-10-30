<?php

declare(strict_types=1);

namespace He4rt\Badge\Actions;

use He4rt\Badge\Contracts\BadgeRepository;

final readonly class DeleteBadge
{
    public function __construct(private BadgeRepository $badgeRepository) {}

    public function handle(int $badgeId): void
    {
        $this->badgeRepository->delete($badgeId);
    }
}
