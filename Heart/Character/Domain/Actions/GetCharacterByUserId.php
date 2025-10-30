<?php

declare(strict_types=1);

namespace Heart\Character\Domain\Actions;

use Heart\Character\Domain\Entities\CharacterEntity;
use Heart\Character\Domain\Repositories\CharacterRepository;

final readonly class GetCharacterByUserId
{
    public function __construct(private CharacterRepository $characterRepository) {}

    public function handle(string $userId): CharacterEntity
    {
        return $this->characterRepository->findByUserId($userId);
    }
}
