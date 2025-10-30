<?php

declare(strict_types=1);

namespace Heart\Character\Domain\Actions;

use Heart\Character\Domain\Enums\VoiceStatesEnum;
use Heart\Character\Domain\Repositories\CharacterRepository;

final readonly class IncrementExperience
{
    public function __construct(
        private CharacterRepository $characterRepository,
        private FindCharacter $findCharacter
    ) {}

    public function incrementByTextMessage(string $characterId, string $message): int
    {
        $characterEntity = $this->findCharacter->handle($characterId);
        $experienceObtained = $characterEntity->level->generateExperience($message);
        $this->characterRepository->updateExperience($characterEntity);

        return $experienceObtained;
    }

    public function incrementByVoiceMessage(string $characterId, VoiceStatesEnum $voiceState): int
    {
        $characterEntity = $this->findCharacter->handle($characterId);
        $experienceObtained = $characterEntity->level->generateVoiceExperience($voiceState);
        $this->characterRepository->updateExperience($characterEntity);

        return $experienceObtained;
    }
}
