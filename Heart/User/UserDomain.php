<?php

declare(strict_types=1);

namespace Heart\User;

use Heart\Core\Contracts\DomainInterface;
use Heart\User\Infrastructure\Providers\UserRouteProvider;
use Heart\User\Infrastructure\Providers\UserServiceProvider;

final class UserDomain extends DomainInterface
{
    public function registerProvider(): array
    {
        return [
            UserServiceProvider::class,
            UserRouteProvider::class,
        ];
    }
}
