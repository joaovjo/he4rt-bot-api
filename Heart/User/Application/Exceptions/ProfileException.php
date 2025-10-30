<?php

declare(strict_types=1);

namespace Heart\User\Application\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

final class ProfileException extends Exception
{
    public static function notFound(): self
    {
        return new self('Profile not found :/', Response::HTTP_NOT_FOUND);
    }
}
