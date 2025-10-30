<?php

declare(strict_types=1);

namespace Heart\User\Infrastructure\Providers;

use Heart\User\Domain\Repositories\UserRepository;
use Heart\User\Infrastructure\Repositories\UserEloquentRepository;
use Illuminate\Support\ServiceProvider;

final class UserServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepository::class, UserEloquentRepository::class);
    }
}
