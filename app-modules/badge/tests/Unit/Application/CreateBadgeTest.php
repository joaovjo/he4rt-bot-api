<?php

declare(strict_types=1);

use He4rt\Badge\Actions\CreateBadge;
use He4rt\Badge\Actions\PersistBadge;
use He4rt\Badge\DTOs\NewBadgeDTO;
use He4rt\Badge\Tests\Unit\BadgeProviderTrait;
use Mockery as m;

uses(BadgeProviderTrait::class);

beforeEach(function (): void {
    $this->persistBadgeStub = m::mock(PersistBadge::class);
    $this->badgeEntity = $this->validBadgeEntity();
});

afterEach(function (): void {
    m::close();
});

test('create badge application success', function (): void {
    $this->persistBadgeStub
        ->shouldReceive('handle')
        ->with(m::type(NewBadgeDTO::class))
        ->once()
        ->andReturn($this->badgeEntity);

    $test = new CreateBadge($this->persistBadgeStub);

    $test->handle([
        'provider' => 'canhassi-provider',
        'name' => 'canhassi',
        'description' => 'é o canhas, esqueça tudo!',
        'image_url' => 'https://canhassi.tech',
        'redeem_code' => 'he4rtDevelopers',
        'active' => true,
    ]);
});
