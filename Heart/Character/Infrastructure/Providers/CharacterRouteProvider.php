<?php

declare(strict_types=1);

namespace Heart\Character\Infrastructure\Providers;

use Heart\Character\Presentation\Controllers\CharactersController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

final class CharacterRouteProvider extends RouteServiceProvider
{
    public function map(): void
    {
        Route::prefix('api')->middleware(['api', 'bot-auth'])->group(function (): void {
            Route::prefix('characters')->group(function (): void {
                Route::get('/', [CharactersController::class, 'getCharacters'])
                    ->name('characters.getCharacters');
                Route::get('/{provider}', [CharactersController::class, 'getCharacter'])
                    ->name('characters.getCharacter');
                Route::post('/{provider}/{providerId}/daily', [CharactersController::class, 'postDailyBonus'])
                    ->name('characters.dailyReward');
                Route::post('/{provider}/{providerId}/claimBadge', [CharactersController::class, 'postClaimBadge'])
                    ->name('characters.claimBadge');
            });
        });
    }
}
