<?php

declare(strict_types=1);

namespace He4rt\Message\Repositories;

use He4rt\Message\DTOs\NewVoiceMessageDTO;
use He4rt\Message\Entities\VoiceEntity;

interface VoiceRepository
{
    public function create(NewVoiceMessageDTO $messageDTO, string $providerId, int $obtainedExperience): VoiceEntity;
}
