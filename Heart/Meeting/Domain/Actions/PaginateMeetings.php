<?php

declare(strict_types=1);

namespace Heart\Meeting\Domain\Actions;

use Heart\Meeting\Domain\Repositories\MeetingRepository;
use Heart\Shared\Domain\Paginator;

final readonly class PaginateMeetings
{
    public function __construct(private MeetingRepository $repository) {}

    public function handle(): Paginator
    {
        return $this->repository->paginate(['meetingType']);
    }
}
