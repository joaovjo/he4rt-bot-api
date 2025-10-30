<?php

declare(strict_types=1);

namespace Heart\Feedback\Infrastructure\Providers;

use Heart\Feedback\Domain\Repositories\FeedbackRepository;
use Heart\Feedback\Infrastructure\Repositories\FeedbackEloquentRepository;
use Illuminate\Support\ServiceProvider;

final class FeedbackServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(FeedbackRepository::class, FeedbackEloquentRepository::class);
    }
}
