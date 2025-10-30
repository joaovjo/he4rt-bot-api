<?php

declare(strict_types=1);

namespace He4rt\Message\Repositories;

use He4rt\Message\DTOs\NewVoiceMessageDTO;
use He4rt\Message\Entities\VoiceEntity;
use He4rt\Message\Models\Voice;

final readonly class VoiceEloquentRepository implements VoiceRepository
{
    public function __construct(private Voice $model) {}

    public function create(NewVoiceMessageDTO $messageDTO, string $providerId, int $obtainedExperience): VoiceEntity
    {
        $model = $this->model->newQuery()->create([
            'provider_id' => $providerId,
            'season_id' => config('he4rt.season.id'),
            'channel_name' => $messageDTO->channelName,
            'state' => $messageDTO->voiceState->value,
            'obtained_experience' => $obtainedExperience,
        ]);

        return VoiceEntity::make($model->toArray());
    }
}
