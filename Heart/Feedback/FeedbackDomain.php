<?php

declare(strict_types=1);

namespace Heart\Feedback;

use Heart\Core\Contracts\DomainInterface;
use Heart\Feedback\Infrastructure\Providers\FeedbackRouteProvider;
use Heart\Feedback\Infrastructure\Providers\FeedbackServiceProvider;

final class FeedbackDomain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            FeedbackServiceProvider::class,
            FeedbackRouteProvider::class,
        ];
    }
}
