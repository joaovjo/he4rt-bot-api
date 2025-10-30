<?php

declare(strict_types=1);

namespace Heart\Authentication\OAuth\Infrastructure\Providers;

use Heart\Authentication\OAuth\Presentation\Controllers\OAuthController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

final class AuthenticationRouteProvider extends RouteServiceProvider
{
    public function map(): void
    {
        Route::prefix('auth')
            ->middleware('web')
            ->group(function (): void {
                Route::prefix('oauth')->group(function (): void {
                    Route::get('/{provider}', [OAuthController::class, 'getAuthenticate']);
                    Route::get('/{provider}/redirect', [OAuthController::class, 'getRedirect']);
                });
            });
    }
}
