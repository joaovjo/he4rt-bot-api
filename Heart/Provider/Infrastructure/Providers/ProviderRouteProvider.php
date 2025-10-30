<?php

declare(strict_types=1);

namespace Heart\Provider\Infrastructure\Providers;

use Heart\Provider\Presentation\Controllers\ProvidersController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

final class ProviderRouteProvider extends RouteServiceProvider
{
    public function map(): void
    {
        Route::prefix('api')->middleware(['api', 'bot-auth'])->group(function (): void {
            Route::post('/providers/{provider}', [ProvidersController::class, 'postProvider'])
                ->name('providers.store');
        });
    }
}
