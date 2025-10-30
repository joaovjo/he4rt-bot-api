<?php

declare(strict_types=1);

namespace Heart\Season\Infrastructure\Providers;

use Heart\Season\Domain\Repositories\SeasonRepository;
use Heart\Season\Infrastructure\Repositories\SeasonEloquentRepository;
use Illuminate\Support\ServiceProvider;

final class SeasonServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(SeasonRepository::class, SeasonEloquentRepository::class);
    }
}
