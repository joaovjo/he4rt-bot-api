<?php

declare(strict_types=1);

namespace Heart\User\Application;

use Heart\Shared\Domain\Paginator;
use Heart\User\Domain\Repositories\UserRepository;

final readonly class GetUsersPaginated
{
    public function __construct(private UserRepository $repository) {}

    public function handle(): Paginator
    {
        return $this->repository
            ->paginated();
    }
}
