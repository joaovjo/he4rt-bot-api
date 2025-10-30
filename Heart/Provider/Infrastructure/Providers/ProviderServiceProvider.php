<?php

declare(strict_types=1);

namespace Heart\Provider\Infrastructure\Providers;

use Heart\Provider\Domain\Repositories\ProviderRepository;
use Heart\Provider\Infrastructure\Repositories\ProviderEloquentRepository;
use Illuminate\Support\ServiceProvider;

final class ProviderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ProviderRepository::class, ProviderEloquentRepository::class);
    }
}
