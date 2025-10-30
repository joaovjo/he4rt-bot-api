<?php

declare(strict_types=1);

namespace Heart\Ranking\Domain\Repositories;

use Heart\Shared\Domain\Paginator;

interface RankingRepository
{
    public function rankingByLevel(): Paginator;
}
