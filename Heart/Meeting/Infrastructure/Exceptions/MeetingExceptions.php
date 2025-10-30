<?php

declare(strict_types=1);

namespace Heart\Meeting\Infrastructure\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

final class MeetingExceptions extends Exception
{
    public static function meetingTypeNotFound(): self
    {
        return new self('meeting type not found!!', Response::HTTP_NOT_FOUND);
    }
}
