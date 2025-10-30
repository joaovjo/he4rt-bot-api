<?php

declare(strict_types=1);

namespace Heart\Ranking\Infrastructure\Providers;

use Heart\Ranking\Domain\Actions\RankingByLevel;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

final class RankingRouteProvider extends RouteServiceProvider
{
    public function map(): void
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(function (): void {
                Route::get('/ranking/leveling', [RankingByLevel::class, 'handle'])->name('ranking.leveling');
            });
    }
}
