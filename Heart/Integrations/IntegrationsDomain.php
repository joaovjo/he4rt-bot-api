<?php

declare(strict_types=1);

namespace Heart\Integrations;

use Heart\Core\Contracts\DomainInterface;
use Heart\Integrations\Twitch\Common\TwitchIntegrationProvider;

final class IntegrationsDomain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            TwitchIntegrationProvider::class,
        ];
    }
}
