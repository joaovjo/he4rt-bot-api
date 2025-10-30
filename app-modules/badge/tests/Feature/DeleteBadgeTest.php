<?php


use He4rt\Badge\Models\Badge;
use Symfony\Component\HttpFoundation\Response;


test('can delete badge', function () {
    $badge = Badge::factory()->create();

    $this->actingAsAdmin()
        ->deleteJson(route('badges.destroy', ['badgeId' => $badge->id]))
        ->assertStatus(Response::HTTP_NO_CONTENT);

    $this->assertDatabaseMissing('badges', [
        'id' => $badge->id,
    ]);
});
