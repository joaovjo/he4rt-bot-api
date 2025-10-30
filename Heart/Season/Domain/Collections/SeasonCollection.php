<?php

declare(strict_types=1);

namespace Heart\Season\Domain\Collections;

use ArrayIterator;
use Heart\Season\Domain\Entities\SeasonEntity;
use JsonSerializable;

final class SeasonCollection extends ArrayIterator implements JsonSerializable
{
    public static function make(array $seasonsPayload): self
    {
        $seasons = [];
        foreach ($seasonsPayload as $seasonPayload) {
            $seasons[] = SeasonEntity::make($seasonPayload);
        }

        return new self($seasons);
    }

    public function add(SeasonEntity $seasonEntity): self
    {
        $this->append($seasonEntity);

        return $this;
    }

    public function jsonSerialize(): array
    {
        return $this->getArrayCopy();
    }
}
