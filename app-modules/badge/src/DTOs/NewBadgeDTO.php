<?php

declare(strict_types=1);

namespace He4rt\Badge\DTOs;

use JsonSerializable;

final readonly class NewBadgeDTO implements JsonSerializable
{
    public function __construct(
        private string $provider,
        private string $name,
        private string $description,
        private string $imageUrl,
        private string $redeemCode,
        private bool $active,
    ) {}

    public static function make(array $payload): self
    {
        return new self(
            provider: $payload['provider'],
            name: $payload['name'],
            description: $payload['description'],
            imageUrl: $payload['image_url'],
            redeemCode: $payload['redeem_code'],
            active: $payload['active']
        );
    }

    public function jsonSerialize(): array
    {
        return [
            'provider' => $this->provider,
            'name' => $this->name,
            'description' => $this->description,
            'image_url' => $this->imageUrl,
            'redeem_code' => $this->redeemCode,
            'active' => $this->active,
        ];
    }
}
