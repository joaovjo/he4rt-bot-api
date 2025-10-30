<?php

declare(strict_types=1);

use He4rt\Message\Actions\NewMessage;
use He4rt\Message\Actions\PersistMessage;
use He4rt\Message\DTOs\NewMessageDTO;
use Heart\Character\Application\FindCharacterIdByUserId;
use Heart\Character\Domain\Actions\IncrementExperience;
use Heart\Meeting\Application\AttendMeeting;
use Heart\Provider\Application\FindProvider;
use Heart\Provider\Application\NewAccountByProvider;
use Heart\Provider\Domain\Entities\ProviderEntity;
use Illuminate\Support\Facades\Cache;

test('new message', function (string $provider, array $payload): void {
    Cache::shouldReceive('tags->has')
        ->once()
        ->with('current-meeting')
        ->andReturn(true);

    Cache::shouldReceive('tags->has')
        ->once()
        ->with('meeting-id-user-foda-attended')
        ->andReturn(false);

    $findProviderStub = Mockery::mock(FindProvider::class);
    $findCharacterStub = Mockery::mock(FindCharacterIdByUserId::class);
    $characterExperienceStub = Mockery::mock(IncrementExperience::class);
    $persistMessageStub = Mockery::mock(PersistMessage::class);
    $attendMeetingStub = Mockery::mock(AttendMeeting::class);
    $newUserStub = Mockery::mock(NewAccountByProvider::class);

    $obtainedExperience = 1;
    $providerEntityMock = new ProviderEntity(
        '1',
        'id-user-foda',
        'twitch',
        '12312312',
        'email@foda.com'
    );

    $findProviderStub
        ->shouldReceive('handle')
        ->with($provider, $payload['provider_id'])
        ->andReturn($providerEntityMock);

    $findCharacterStub
        ->shouldReceive('handle')
        ->once()
        ->with($providerEntityMock->userId)
        ->andReturn('id-character-foda');

    $characterExperienceStub
        ->shouldReceive('incrementByTextMessage')
        ->once()
        ->with('id-character-foda', $payload['content'])
        ->andReturn($obtainedExperience);

    $persistMessageStub
        ->shouldReceive('handle')
        ->once()
        ->with(Mockery::type(NewMessageDTO::class), $obtainedExperience, $providerEntityMock->id);

    $attendMeetingStub
        ->shouldReceive('handle')
        ->once()
        ->with($providerEntityMock->userId);

    $action = new NewMessage(
        $persistMessageStub,
        $findProviderStub,
        $findCharacterStub,
        $characterExperienceStub,
        $attendMeetingStub,
        $newUserStub
    );

    $action->persist($payload);
})->with('dataProvider');

dataset('dataProvider', fn () => [
    'twitch #1' => [
        'provider' => 'twitch',
        'payload' => [
            'provider' => 'twitch',
            'provider_id' => '1234',
            'provider_message_id' => '78781237',
            'channel_id' => '31231267312',
            'content' => 'deixa o sub',
            'sent_at' => '2023-01-18 22:36:32',
        ],
    ],
]);
