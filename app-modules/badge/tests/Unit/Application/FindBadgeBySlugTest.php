<?php

use Heart\Badges\Application\FindBadgeBySlug;
use Heart\Badges\Domain\Entities\BadgeEntity;
use Heart\Badges\Domain\Repositories\BadgeRepository;

uses(Unit\BadgeProviderTrait::class);

beforeEach(function () {
    $this->badgeRepositoryStub = m::mock(BadgeRepository::class);
    $this->badgeEntity = $this->validBadgeEntity();
});

afterEach(function () {
    m::close();
});

test('find badge by slug', function () {
    $slug = 'é-o-canhas';
    $this->badgeRepositoryStub
        ->shouldReceive('findBySlug')
        ->with($slug)
        ->once()
        ->andReturn($this->badgeEntity);

    $test = new FindBadgeBySlug($this->badgeRepositoryStub);

    $test->handle($slug);
});
