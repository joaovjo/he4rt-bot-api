<?php

declare(strict_types=1);

namespace Tests\Feature\Feedback;

use Heart\Feedback\Infrastructure\Models\Feedback;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

final class GetFeedbackByIdTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_find_by_id(): void
    {
        $feedback = Feedback::factory()->create();

        $this
            ->actingAsAdmin()
            ->getJson(route('feedbacks.show', ['feedbackId' => $feedback->id]))
            ->assertStatus(Response::HTTP_OK);
    }
}
