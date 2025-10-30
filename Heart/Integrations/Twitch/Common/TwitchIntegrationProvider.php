<?php

declare(strict_types=1);

namespace Heart\Integrations\Twitch\Common;

use Heart\Integrations\Twitch\OAuth\Domain\TwitchOAuthService;
use Heart\Integrations\Twitch\OAuth\Infrastructure\TwitchOAuthClient;
use Illuminate\Support\ServiceProvider;

final class TwitchIntegrationProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TwitchService::class, TwitchBaseClient::class);
        $this->app->bind(TwitchOAuthService::class, TwitchOAuthClient::class);
    }
}
