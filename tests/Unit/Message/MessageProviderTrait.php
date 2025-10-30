<?php

declare(strict_types=1);

namespace Tests\Unit\Message;

use DateTimeImmutable;
use Heart\Message\Domain\Entities\MessageEntity;
use Illuminate\Support\Facades\Date;

trait MessageProviderTrait
{
    public function validMessagePayload(array $fields = []): array
    {
        return [
            'id' => 'canhassi-id',
            'provider_id' => 'é-o-canhas-id',
            'provider_message_id' => 'he4rtDevelopers',
            'season_id' => 12,
            'channel_id' => 'canal-foda',
            'content' => 'conteudo-foda',
            'sent_at' => new DateTimeImmutable(Date::now()->toString()),
            'obtained_experience' => 12,
            ...$fields,
        ];
    }

    public function validMessageEntity(): MessageEntity
    {
        return MessageEntity::make($this->validMessagePayload());
    }
}
