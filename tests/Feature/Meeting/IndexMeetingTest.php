<?php

declare(strict_types=1);

namespace Tests\Feature\Meeting;

use Heart\Meeting\Infrastructure\Models\Meeting;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

final class IndexMeetingTest extends TestCase
{
    use DatabaseTransactions;

    public function test_bot_can_list_all_meetings(): void
    {
        // Arrange
        Meeting::factory()->unfinished()->create();

        // Act
        $response = $this->actingAsAdmin()
            ->get(route('events.meeting.getMeetings', ['provider' => 'discord']));

        // Assert
        $response->assertOk();
        $response->assertJsonStructure(
            [
                'data' => [
                    0 => [
                        'id',
                        'content',
                        'meeting_type_id',
                        'admin_id',
                        'starts_at',
                        'ends_at',
                        'created_at',
                        'updated_at',
                        'meeting_type' => [
                            'id',
                            'name',
                            'week_day',
                            'start_at',
                            'created_at',
                            'updated_at',
                        ],
                    ],
                ],
            ]
        );
    }
}
