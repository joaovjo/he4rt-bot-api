<?php

declare(strict_types=1);

namespace Heart\Character\Infrastructure\Providers;

use Heart\Character\Domain\Repositories\CharacterRepository;
use Heart\Character\Infrastructure\Repositories\CharacterEloquentRepository;
use Illuminate\Support\ServiceProvider;

final class CharacterServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CharacterRepository::class, CharacterEloquentRepository::class);
    }
}
