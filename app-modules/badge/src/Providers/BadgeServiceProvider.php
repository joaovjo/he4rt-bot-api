<?php

namespace He4rt\Badge\Providers;

use He4rt\Badge\Contracts\BadgeRepository;
use He4rt\Badge\Repositories\BadgeEloquentRepository;
use Illuminate\Support\ServiceProvider;

class BadgeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(BadgeRepository::class, BadgeEloquentRepository::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }
}
