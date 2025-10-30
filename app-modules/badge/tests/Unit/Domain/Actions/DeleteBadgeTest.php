<?php

declare(strict_types=1);

use He4rt\Badge\Actions\DeleteBadge;
use He4rt\Badge\Contracts\BadgeRepository;
use He4rt\Badge\Tests\Unit\BadgeProviderTrait;
use Mockery as m;

uses(BadgeProviderTrait::class);

beforeEach(function (): void {
    $this->badgeRepositoryStub = m::mock(BadgeRepository::class);
    $this->badgeEntity = $this->validBadgeEntity();
});

afterEach(function (): void {
    m::close();
});

test('delete badge success', function (): void {
    $this->badgeRepositoryStub
        ->shouldReceive('delete')
        ->with($this->badgeEntity->id)
        ->once();

    $test = new DeleteBadge($this->badgeRepositoryStub);

    $test->handle($this->badgeEntity->id);
});
