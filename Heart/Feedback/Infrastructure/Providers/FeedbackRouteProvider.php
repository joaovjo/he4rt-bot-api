<?php

declare(strict_types=1);

namespace Heart\Feedback\Infrastructure\Providers;

use Heart\Feedback\Presentation\Controllers\FeedbacksController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

final class FeedbackRouteProvider extends RouteServiceProvider
{
    public function map(): void
    {
        Route::prefix('api')->middleware(['api', 'bot-auth'])->group(function (): void {
            Route::get('feedbacks/{feedbackId}', [FeedbacksController::class, 'getFeedback'])
                ->name('feedbacks.show');
            Route::post('feedbacks', [FeedbacksController::class, 'postFeedback'])
                ->name('feedbacks.create');
            Route::post('feedbacks/{feedbackId}/{action}', [FeedbacksController::class, 'postReview'])
                ->name('feedbacks.review');
        });
    }
}
