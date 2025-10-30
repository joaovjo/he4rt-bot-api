<?php

use App\Http\Middleware\BotAuthentication;
use He4rt\Badge\Http\Controllers\BadgesController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api', 'middleware' => [BotAuthentication::class]],function () {
    Route::prefix('badges')->group(function () {
        Route::get('/', [BadgesController::class, 'getBadges'])->name('badges.index');
        Route::post('/', [BadgesController::class, 'postBadge'])->name('badges.store');
        Route::delete('/{badgeId}', [BadgesController::class, 'deleteBadge'])->name('badges.destroy');
    });
});
