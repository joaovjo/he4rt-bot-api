<?php

declare(strict_types=1);

use Heart\Badges\Application\FindBadgeBySlug;
use Heart\Badges\Domain\Repositories\BadgeRepository;
use Unit\BadgeProviderTrait;

uses(BadgeProviderTrait::class);

beforeEach(function (): void {
    $this->badgeRepositoryStub = m::mock(BadgeRepository::class);
    $this->badgeEntity = $this->validBadgeEntity();
});

afterEach(function (): void {
    m::close();
});

test('find badge by slug', function (): void {
    $slug = 'é-o-canhas';
    $this->badgeRepositoryStub
        ->shouldReceive('findBySlug')
        ->with($slug)
        ->once()
        ->andReturn($this->badgeEntity);

    $test = new FindBadgeBySlug($this->badgeRepositoryStub);

    $test->handle($slug);
});
