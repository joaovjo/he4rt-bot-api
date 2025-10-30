<?php

declare(strict_types=1);

namespace Heart\Character\Domain\Actions;

use Heart\Character\Domain\Repositories\CharacterRepository;

final readonly class PersistClaimedBadge
{
    public function __construct(private CharacterRepository $characterRepository) {}

    public function handle(string $characterId, int $badgeId): void
    {
        $this->characterRepository->claimBadge($characterId, $badgeId);
    }
}
