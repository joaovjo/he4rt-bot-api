<?php

declare(strict_types=1);

namespace Heart\Character\Domain\Actions;

use Heart\Character\Domain\Repositories\CharacterRepository;

final readonly class ManageReputation
{
    public function __construct(private CharacterRepository $characterRepository) {}

    public function handle(string $characterId, string $type): void
    {
        $character = $this->characterRepository->findById($characterId);
        $character->reputation->handleReputation($type);

        $this->characterRepository->updateReputation($character);
    }
}
