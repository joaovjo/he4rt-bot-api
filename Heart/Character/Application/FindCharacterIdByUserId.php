<?php

declare(strict_types=1);

namespace Heart\Character\Application;

use Heart\Character\Domain\Actions\GetCharacterByUserId;
use Heart\Shared\Application\TTL;
use Illuminate\Support\Facades\Cache;

final readonly class FindCharacterIdByUserId
{
    public function __construct(
        private GetCharacterByUserId $finder
    ) {}

    public function handle(string $userId): string
    {
        $cacheCharacterKey = sprintf('user-%s-character-id', $userId);

        return Cache::remember(
            $cacheCharacterKey,
            TTL::fromDays(2),
            fn () => $this->findCharacterByUserId($userId)
        );
    }

    private function findCharacterByUserId(string $userId): string
    {
        return $this->finder->handle($userId)->id;
    }
}
