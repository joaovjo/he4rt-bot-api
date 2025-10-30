<?php

declare(strict_types=1);

namespace Tests\Feature\Season;

use Heart\Season\Infrastructure\Models\Season;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

final class GetSeasonsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_get_seasons_success(): void
    {
        Season::factory()->create();

        $response = $this->actingAsAdmin()->get(route('get-seasons'));

        $response->assertOk();
        $response->assertJsonStructure([
            [
                'id',
                'name',
                'description',
                'messagesCount',
                'participantsCount',
                'meetingCount',
                'badgesCount',
                'startAt',
                'endAt',
            ],
        ]);
    }
}
