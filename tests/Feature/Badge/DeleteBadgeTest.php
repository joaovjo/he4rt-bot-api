<?php

declare(strict_types=1);

namespace Tests\Feature\Badge;

use Heart\Badges\Infrastructure\Model\Badge;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

final class DeleteBadgeTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_delete_badge(): void
    {
        $badge = Badge::factory()->create();

        $this->actingAsAdmin()
            ->deleteJson(route('badges.destroy', ['badgeId' => $badge->id]))
            ->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('badges', [
            'id' => $badge->id,
        ]);
    }
}
