<?php

namespace He4rt\Message\Actions;

use Heart\Character\Application\FindCharacterIdByUserId;
use Heart\Character\Domain\Actions\IncrementExperience;
use Heart\Meeting\Application\AttendMeeting;
use He4rt\Message\Actions\PersistMessage;
use He4rt\Message\DTOs\NewMessageDTO;
use Heart\Provider\Application\FindProvider;
use Heart\Provider\Application\NewAccountByProvider;
use Heart\Provider\Domain\Entities\ProviderEntity;
use Heart\Provider\Infrastructure\Exceptions\ProviderException;
use Illuminate\Support\Facades\Cache;

class NewMessage
{
    public function __construct(
        private readonly PersistMessage $persistMessage,
        private readonly FindProvider $findProvider,
        private readonly FindCharacterIdByUserId $findCharacterId,
        private readonly IncrementExperience $characterExperience,
        private readonly AttendMeeting $attendMeeting,
        private readonly NewAccountByProvider $createAccount
    ) {
    }

    public function persist(array $payload): void
    {
        $messageDTO = NewMessageDTO::make($payload);
        try {
            $providerEntity = $this->findProvider->handle(
                $messageDTO->provider->value,
                $messageDTO->providerId
            );

        } catch (ProviderException) {
            $providerEntity = $this->createAccount->handle(
                $messageDTO->provider,
                $messageDTO->providerId,
                'discord-' . $messageDTO->providerId
            );
        }

        $obtainedExperience = $this->persistCharacterExperience(
            $providerEntity->userId,
            $messageDTO->content
        );

        $this->persistMessage->handle(
            $messageDTO,
            $obtainedExperience,
            $providerEntity->id,
        );

        $this->meetingAttender($providerEntity);
    }

    private function persistCharacterExperience(string $userId, string $content): int
    {
        $characterId = $this->findCharacterId->handle($userId);

        return $this->characterExperience->incrementByTextMessage($characterId, $content);
    }

    private function meetingAttender(
        ProviderEntity $providerEntity,
    ): void {
        if (! Cache::tags(['meetings'])->has('current-meeting')) {
            return;
        }

        $userAttendedCacheKey = sprintf('meeting-%s-attended', $providerEntity->userId);
        if (Cache::tags(['meetings'])->has($userAttendedCacheKey)) {
            return;
        }

        $this->attendMeeting->handle($providerEntity->userId);
    }
}