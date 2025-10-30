<?php

declare(strict_types=1);

namespace Heart\Ranking;

use Heart\Core\Contracts\DomainInterface;
use Heart\Ranking\Infrastructure\Providers\RankingRouteProvider;
use Heart\Ranking\Infrastructure\Providers\RankingServiceProvider;

final class RankingDomain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            RankingServiceProvider::class,
            RankingRouteProvider::class,
        ];
    }
}
