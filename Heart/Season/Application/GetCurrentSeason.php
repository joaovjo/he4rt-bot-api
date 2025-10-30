<?php

declare(strict_types=1);

namespace Heart\Season\Application;

use Heart\Season\Domain\Entities\SeasonEntity;
use Heart\Season\Domain\Repositories\SeasonRepository;

final readonly class GetCurrentSeason
{
    public function __construct(private SeasonRepository $repository) {}

    public function handle(): SeasonEntity
    {
        return $this->repository->getCurrent();
    }
}
