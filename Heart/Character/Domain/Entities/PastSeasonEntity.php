<?php

declare(strict_types=1);

namespace Heart\Character\Domain\Entities;

use JsonSerializable;

final readonly class PastSeasonEntity implements JsonSerializable
{
    public function __construct(
        private string $id,
        private string $seasonId,
        private string $characterId,
        private int $rankingPosition,
        private int $experience,
        private int $messagesCount,
        private int $badgesCount,
        private int $meetingsCount,
    ) {}

    public static function make(array $payload): self
    {
        return new self(
            id: $payload['id'],
            seasonId: $payload['season_id'],
            characterId: $payload['character_id'],
            rankingPosition: $payload['ranking_position'],
            experience: $payload['experience'],
            messagesCount: $payload['messages_count'],
            badgesCount: $payload['badges_count'],
            meetingsCount: $payload['meetings_count'],
        );
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'season_id' => $this->seasonId,
            'character_id' => $this->characterId,
            'ranking_position' => $this->rankingPosition,
            'experience' => $this->experience,
            'messages_count' => $this->messagesCount,
            'badges_count' => $this->badgesCount,
            'meetings_count' => $this->meetingsCount,
        ];
    }
}
