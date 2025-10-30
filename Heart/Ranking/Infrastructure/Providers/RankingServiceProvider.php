<?php

declare(strict_types=1);

namespace Heart\Ranking\Infrastructure\Providers;

use Heart\Ranking\Domain\Repositories\RankingRepository;
use Heart\Ranking\Infrastructure\Repositories\RankingEloquentRepository;
use Illuminate\Support\ServiceProvider;

final class RankingServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(RankingRepository::class, RankingEloquentRepository::class);
    }
}
