<?php

declare(strict_types=1);

namespace He4rt\Badge\Collections;

use ArrayIterator;
use He4rt\Badge\Entities\BadgeEntity;
use JsonSerializable;

final class BadgeCollection extends ArrayIterator implements JsonSerializable
{
    public static function make(array $badgesPayload): self
    {
        $badges = [];
        foreach ($badgesPayload as $badgePayload) {
            $badges[] = BadgeEntity::make($badgePayload);
        }

        return new self($badges);
    }

    public function add(BadgeEntity $badgeEntity): self
    {
        $this->append($badgeEntity);

        return $this;
    }

    public function jsonSerialize(): array
    {
        return $this->getArrayCopy();
    }
}
