<?php

declare(strict_types=1);

namespace Heart\Shared\Domain\ValueObjects;

final readonly class IntValueObject
{
    public function __construct(private int $value) {}

    public function value(): int
    {
        return $this->value;
    }
}
