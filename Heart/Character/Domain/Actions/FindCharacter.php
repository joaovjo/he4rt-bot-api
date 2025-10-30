<?php

declare(strict_types=1);

namespace Heart\Character\Domain\Actions;

use Heart\Character\Domain\Entities\CharacterEntity;
use Heart\Character\Domain\Repositories\CharacterRepository;

final readonly class FindCharacter
{
    public function __construct(private CharacterRepository $characterRepository) {}

    public function handle(string $characterId): CharacterEntity
    {
        return $this->characterRepository->findById($characterId);
    }
}
