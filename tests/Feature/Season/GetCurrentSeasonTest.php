<?php

declare(strict_types=1);

namespace Tests\Feature\Season;

use Heart\Season\Infrastructure\Models\Season;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

final class GetCurrentSeasonTest extends TestCase
{
    use DatabaseTransactions;

    public function test_get_current_season_success(): void
    {
        $season = Season::factory()->create();

        Config::set('he4rt.season.id', $season->id);

        $response = $this->actingAsAdmin()->get(route('seasons.current'));

        $response->assertOk();
        $response->assertJsonStructure([
            'id',
            'name',
            'description',
            'messagesCount',
            'participantsCount',
            'meetingCount',
            'badgesCount',
            'startAt',
            'endAt',
        ]);
    }
}
