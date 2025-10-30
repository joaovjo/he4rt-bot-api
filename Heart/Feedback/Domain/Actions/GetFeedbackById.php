<?php

declare(strict_types=1);

namespace Heart\Feedback\Domain\Actions;

use Heart\Feedback\Domain\Entities\FeedbackEntity;
use Heart\Feedback\Domain\Repositories\FeedbackRepository;

final readonly class GetFeedbackById
{
    public function __construct(private FeedbackRepository $repository)
    {
    }

    public function handle(string $id): FeedbackEntity
    {
        return $this->repository->findById($id);
    }
}
