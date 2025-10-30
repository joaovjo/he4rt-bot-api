<?php

declare(strict_types=1);

namespace Heart\Shared\Infrastructure;

use Heart\Shared\Domain\Paginator as PaginatorInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorContract;
use Illuminate\Pagination\LengthAwarePaginator;

final class Paginator extends LengthAwarePaginator implements PaginatorInterface
{
    public static function paginate(LengthAwarePaginatorContract $lengthAwarePaginator): self
    {
        return new self(
            $lengthAwarePaginator->items(),
            $lengthAwarePaginator->total(),
            $lengthAwarePaginator->perPage(),
            $lengthAwarePaginator->currentPage()
        );
    }
}
