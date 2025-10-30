<?php

declare(strict_types=1);

use App\Http\Middleware\BotAuthentication;
use He4rt\Message\Http\Controllers\MessagesController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->middleware(['api', BotAuthentication::class])->group(function (): void {
    Route::prefix('messages')->group(function (): void {
        Route::post('/{provider}', [MessagesController::class, 'postMessage'])->name('messages.create');
    });

    Route::prefix('voices')->group(function (): void {
        Route::post('/{provider}', [MessagesController::class, 'postVoiceMessage'])
            ->name('voices.create');
    });
});
