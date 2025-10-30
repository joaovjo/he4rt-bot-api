<?php

declare(strict_types=1);

namespace Heart\Integrations\Twitch\Subscriber\Domain\DTO;

use Heart\Integrations\Twitch\Subscriber\Domain\Enum\SubscriptionTiersEnum;

final readonly class TwitchSubscriberDTO
{
    public function __construct(
        public string $broadcasterId,
        public string $broadcasterLogin,
        public string $broadcasterName,
        public SubscriptionTiersEnum $tier,
        public bool $isGift,
        public ?string $gifterLogin = null,
        public ?string $gifterName = null,
    ) {}

    public static function make(array $payload): self
    {
        return new self(
            $payload['broadcaster_id'],
            $payload['broadcaster_login'],
            $payload['broadcaster_name'],
            SubscriptionTiersEnum::from($payload['tier']),
            (bool) $payload['is_gift'],
            $payload['gifter_login'] ?? null,
            $payload['gifter_name'] ?? null,
        );
    }
}
