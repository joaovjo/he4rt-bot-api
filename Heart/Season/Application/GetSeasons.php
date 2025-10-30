<?php

declare(strict_types=1);

namespace Heart\Season\Application;

use Heart\Season\Domain\Collections\SeasonCollection;
use Heart\Season\Domain\Repositories\SeasonRepository;

final readonly class GetSeasons
{
    public function __construct(private SeasonRepository $repository) {}

    public function handle(): SeasonCollection
    {
        return $this->repository->getAll();
    }
}
