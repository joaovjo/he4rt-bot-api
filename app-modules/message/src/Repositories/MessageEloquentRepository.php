<?php

namespace He4rt\Message\Repositories;

use He4rt\Message\DTOs\NewMessageDTO;
use He4rt\Message\Entities\MessageEntity;
use He4rt\Message\Models\Message;
use Illuminate\Database\Eloquent\Builder;

class MessageEloquentRepository implements MessageRepository
{
    private readonly Builder $query;

    public function __construct(private readonly Message $model)
    {
        $this->query = $this->model->newQuery();
    }

    public function create(NewMessageDTO $messageDTO, string $providerId, int $obtainedExperience): MessageEntity
    {
        $model = $this->query->create([
            'provider_id' => $providerId,
            'provider_message_id' => $messageDTO->providerMessageId,
            'season_id' => (int) config('he4rt.season.id'),
            'channel_id' => $messageDTO->channelId,
            'content' => $messageDTO->content,
            'sent_at' => $messageDTO->sentAt,
            'obtained_experience' => $obtainedExperience,
        ]);

        return MessageEntity::make($model->toArray());
    }
}