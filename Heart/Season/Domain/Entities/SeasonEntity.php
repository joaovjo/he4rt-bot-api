<?php

declare(strict_types=1);

namespace Heart\Season\Domain\Entities;

use DateTimeImmutable;

final class SeasonEntity
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description,
        public int $messagesCount,
        public int $participantsCount,
        public int $meetingCount,
        public int $badgesCount,
        public DateTimeImmutable $startAt,
        public ?DateTimeImmutable $endAt,
    ) {}

    public static function make(array $payload): self
    {
        $endsAt = empty($payload['ended_at'])
            ? null
            : new DateTimeImmutable($payload['ended_at']);

        return new self(
            id: $payload['id'],
            name: $payload['name'],
            description: $payload['description'],
            messagesCount: $payload['messages_count'],
            participantsCount: $payload['participants_count'],
            meetingCount: $payload['meeting_count'],
            badgesCount: $payload['badges_count'],
            startAt: new DateTimeImmutable($payload['started_at']),
            endAt: $endsAt,
        );
    }
}
