<?php

declare(strict_types=1);

namespace Tests\Unit\User\Domain\Application;

use Heart\Shared\Domain\Paginator;
use Heart\User\Application\GetUsersPaginated;
use Heart\User\Domain\Repositories\UserRepository;
use Mockery as m;
use Mockery\MockInterface;
use Tests\TestCase;

final class GetUsersPaginatedTest extends TestCase
{
    private MockInterface $repositoryStub;

    private MockInterface $paginatorStub;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repositoryStub = m::mock(UserRepository::class);
        $this->paginatorStub = m::mock(Paginator::class);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        m::close();
    }

    public function test_get_users_paginated(): void
    {
        $this->repositoryStub
            ->shouldReceive('paginated')
            ->once()
            ->andReturn($this->paginatorStub);

        $test = new GetUsersPaginated($this->repositoryStub);

        $test->handle();
    }
}
