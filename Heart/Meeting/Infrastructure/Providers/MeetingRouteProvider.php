<?php

declare(strict_types=1);

namespace Heart\Meeting\Infrastructure\Providers;

use Heart\Meeting\Presentation\Controllers\MeetingController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

final class MeetingRouteProvider extends RouteServiceProvider
{
    public function map(): void
    {
        Route::prefix('api')->middleware(['api', 'bot-auth'])->group(function (): void {
            Route::prefix('events/{provider}')->name('events.')->group(function (): void {
                Route::prefix('meeting')->name('meeting.')->group(function (): void {
                    Route::get('/', [MeetingController::class, 'getMeetings'])->name('getMeetings');
                    Route::post('/start', [MeetingController::class, 'postMeeting'])->name('postMeeting');
                    Route::post('/end', [MeetingController::class, 'postEndMeeting'])->name('postEndMeeting');
                });
            });
        });
    }
}
