<?php

declare(strict_types=1);

namespace He4rt\Badge\Repositories;

use He4rt\Badge\Contracts\BadgeRepository;
use He4rt\Badge\DTOs\NewBadgeDTO;
use He4rt\Badge\Entities\BadgeEntity;
use He4rt\Badge\Models\Badge;

final readonly class BadgeEloquentRepository implements BadgeRepository
{
    public function __construct(private Badge $model) {}

    public function create(NewBadgeDTO $badgeDTO): BadgeEntity
    {
        $model = $this->model->newQuery()->create($badgeDTO->jsonSerialize());

        return BadgeEntity::make($model->toArray());
    }

    public function findBySlug(string $badgeSlug): BadgeEntity
    {
        $model = $this->model
            ->newQuery()
            ->where('redeem_code', $badgeSlug)
            ->firstOrFail();

        return BadgeEntity::make($model->toArray());
    }

    public function delete(string $badgeId): void
    {
        $this->model->newQuery()
            ->find($badgeId)
            ->delete();
    }
}
