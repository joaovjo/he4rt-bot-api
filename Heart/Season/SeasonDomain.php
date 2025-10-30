<?php

declare(strict_types=1);

namespace Heart\Season;

use Heart\Core\Contracts\DomainInterface;
use Heart\Season\Infrastructure\Providers\SeasonRouteProvider;
use Heart\Season\Infrastructure\Providers\SeasonServiceProvider;

final class SeasonDomain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            SeasonServiceProvider::class,
            SeasonRouteProvider::class,
        ];
    }
}
