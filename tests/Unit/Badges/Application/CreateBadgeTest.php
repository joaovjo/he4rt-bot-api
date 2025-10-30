<?php

declare(strict_types=1);

namespace Tests\Unit\Badges\Application;

use He4rt\Badge\Actions\CreateBadge;
use He4rt\Badge\Actions\PersistBadge;
use He4rt\Badge\DTOs\NewBadgeDTO;
use He4rt\Badge\Entities\BadgeEntity;
use He4rt\Badge\Tests\Unit\BadgeProviderTrait;
use Mockery as m;
use Mockery\MockInterface;
use Tests\TestCase;

final class CreateBadgeTest extends TestCase
{
    use BadgeProviderTrait;

    private MockInterface $persistBadgeStub;

    private BadgeEntity $badgeEntity;

    private array $payload;

    protected function setUp(): void
    {
        parent::setUp();
        $this->persistBadgeStub = m::mock(PersistBadge::class);
        $this->badgeEntity = $this->validBadgeEntity();
        $this->payload = $this->dataProvider();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        m::close();
    }

    public function test_create_badge_application_success(): void
    {
        $this->persistBadgeStub
            ->shouldReceive('handle')
            ->with(m::type(NewBadgeDTO::class))
            ->once()
            ->andReturn($this->badgeEntity);

        $test = new CreateBadge($this->persistBadgeStub);

        $test->handle($this->payload);
    }

    private function dataProvider(): array
    {
        return [
            'provider' => 'canhassi-provider',
            'name' => 'canhassi',
            'description' => 'é o canhas, esqueça tudo!',
            'image_url' => 'https://canhassi.tech',
            'redeem_code' => 'he4rtDevelopers',
            'active' => true,
        ];
    }
}
