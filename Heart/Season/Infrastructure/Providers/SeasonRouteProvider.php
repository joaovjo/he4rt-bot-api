<?php

declare(strict_types=1);

namespace Heart\Season\Infrastructure\Providers;

use Heart\Season\Presentation\Controllers\SeasonsController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

final class SeasonRouteProvider extends RouteServiceProvider
{
    public function map(): void
    {
        Route::prefix('season')->group(function (): void {
            Route::get('/v2/seasons', [SeasonsController::class, 'getSeasons'])->name('get-seasons');
            Route::get('/v2/seasons/current', [SeasonsController::class, 'getCurrent'])
                ->name('seasons.current');
        });
    }
}
