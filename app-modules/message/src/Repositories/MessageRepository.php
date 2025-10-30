<?php

namespace He4rt\Message\Repositories;

use He4rt\Message\DTOs\NewMessageDTO;
use He4rt\Message\Entities\MessageEntity;

interface MessageRepository
{
    public function create(NewMessageDTO $payload, string $providerId, int $obtainedExperience): MessageEntity;
}