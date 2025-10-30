<?php

declare(strict_types=1);

namespace Heart\Character\Domain\Actions;

use Heart\Character\Domain\Repositories\CharacterRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final readonly class PaginateCharacters
{
    public function __construct(private CharacterRepository $characterRepository) {}

    public function handle(): LengthAwarePaginator
    {
        return $this->characterRepository->paginate();
    }
}
