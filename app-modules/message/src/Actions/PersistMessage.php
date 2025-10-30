<?php

declare(strict_types=1);

namespace He4rt\Message\Actions;

use He4rt\Message\DTOs\NewMessageDTO;
use He4rt\Message\Entities\MessageEntity;
use He4rt\Message\Repositories\MessageRepository;

final readonly class PersistMessage
{
    public function __construct(
        private MessageRepository $messageRepository
    ) {}

    public function handle(
        NewMessageDTO $messageDTO,
        int $obtainedExperience,
        string $providerEntity
    ): MessageEntity {
        return $this->messageRepository->create($messageDTO, $providerEntity, $obtainedExperience);
    }
}
