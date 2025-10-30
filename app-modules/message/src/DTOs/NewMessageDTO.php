<?php

namespace He4rt\Message\DTOs;

use Heart\Provider\Domain\Enums\ProviderEnum;

class NewMessageDTO
{
    public function __construct(
        public ProviderEnum $provider,
        public string $providerId,
        public string $providerMessageId,
        public string $channelId,
        public string $content,
        public \DateTime $sentAt,
    ) {
    }

    public static function make(array $payload): self
    {
        return new self(
            provider: ProviderEnum::from($payload['provider']),
            providerId: $payload['provider_id'],
            providerMessageId: $payload['provider_message_id'],
            channelId: $payload['channel_id'],
            content: $payload['content'],
            sentAt: new \DateTime($payload['sent_at'])
        );
    }
}