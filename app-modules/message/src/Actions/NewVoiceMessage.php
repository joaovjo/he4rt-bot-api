<?php

declare(strict_types=1);

namespace He4rt\Message\Actions;

use He4rt\Message\DTOs\NewVoiceMessageDTO;
use He4rt\Message\Repositories\VoiceRepository;
use Heart\Character\Application\FindCharacterIdByUserId;
use Heart\Character\Domain\Actions\IncrementExperience;
use Heart\Provider\Application\FindProvider;

final readonly class NewVoiceMessage
{
    public function __construct(
        private FindProvider $findProvider,
        private FindCharacterIdByUserId $findCharacterId,
        private IncrementExperience $characterExperience,
        private VoiceRepository $voiceRepository
    ) {}

    public function persist(array $payload): void
    {
        $voiceDTO = NewVoiceMessageDTO::make($payload);
        $provider = $this->findProvider->handle(
            $voiceDTO->provider->value,
            $voiceDTO->providerId
        );

        $characterId = $this->findCharacterId->handle($provider->userId);
        $obtainedExperience = $this->characterExperience->incrementByVoiceMessage(
            $characterId,
            $voiceDTO->voiceState
        );

        $this->voiceRepository->create($voiceDTO, $provider->id, $obtainedExperience);
    }
}
