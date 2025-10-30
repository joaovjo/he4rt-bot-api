<?php

declare(strict_types=1);

namespace Heart\Feedback\Domain\Actions;

use Heart\Feedback\Domain\DTOs\FeedbackReviewDTO;
use Heart\Feedback\Domain\Repositories\FeedbackRepository;

final readonly class PersistFeedbackReview
{
    public function __construct(private FeedbackRepository $feedbackRepository) {}

    public function handle(FeedbackReviewDTO $feedbackReviewDTO): void
    {
        $this->feedbackRepository->reviewFeedback($feedbackReviewDTO);
    }
}
