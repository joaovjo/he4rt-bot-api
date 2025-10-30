<?php

declare(strict_types=1);

use App\Providers\AppServiceProvider;
use App\Providers\EventServiceProvider;
use App\Providers\RouteServiceProvider;
use Heart\Core\Providers\CoreProvider;

return [
    AppServiceProvider::class,
    RouteServiceProvider::class,
    EventServiceProvider::class,
    CoreProvider::class,
];
