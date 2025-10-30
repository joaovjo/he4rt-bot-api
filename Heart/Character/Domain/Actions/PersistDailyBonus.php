<?php

declare(strict_types=1);

namespace Heart\Character\Domain\Actions;

use Heart\Character\Domain\Exceptions\CharacterException;
use Heart\Character\Domain\Repositories\CharacterRepository;

final readonly class PersistDailyBonus
{
    public function __construct(private CharacterRepository $characterRepository) {}

    public function handle(string $characterId): void
    {
        $character = $this->characterRepository->findById($characterId);
        throw_unless($character->dailyReward->canClaim(), CharacterException::alreadyClaimed($character->dailyReward));

        $this->characterRepository->claimDailyBonus($character);
    }
}
