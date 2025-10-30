<?php

declare(strict_types=1);

namespace Heart\Provider;

use Heart\Core\Contracts\DomainInterface;
use Heart\Provider\Infrastructure\Providers\ProviderRouteProvider;
use Heart\Provider\Infrastructure\Providers\ProviderServiceProvider;

final class ProviderDomain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            ProviderServiceProvider::class,
            ProviderRouteProvider::class,
        ];
    }
}
