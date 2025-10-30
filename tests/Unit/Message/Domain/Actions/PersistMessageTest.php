<?php

declare(strict_types=1);

namespace Tests\Unit\Message\Domain\Actions;

use Heart\Message\Domain\Actions\PersistMessage;
use Heart\Message\Domain\DTO\NewMessageDTO;
use Heart\Message\Domain\Entities\MessageEntity;
use Heart\Message\Domain\Repositories\MessageRepository;
use Heart\Provider\Domain\Enums\ProviderEnum;
use Illuminate\Support\Facades\Date;
use Mockery as m;
use Mockery\MockInterface;
use Tests\TestCase;
use Tests\Unit\Message\MessageProviderTrait;

final class PersistMessageTest extends TestCase
{
    use MessageProviderTrait;
    public $messageDTO;

    private MessageEntity $messageEntity;

    private MockInterface $messageRepositoryStub;

    protected function setUp(): void
    {
        parent::setUp();
        $this->messageRepositoryStub = m::mock(MessageRepository::class);
        $this->messageEntity = $this->validMessageEntity();
        $this->messageDTO = new NewMessageDTO(
            ProviderEnum::Discord,
            $this->messageEntity->providerId,
            $this->messageEntity->providerMessageId,
            $this->messageEntity->channelId,
            $this->messageEntity->content,
            Date::parse('2023-01-24') // sentAt in string
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        m::close();
    }

    public function test_persist_message_success(): void
    {
        $this->messageRepositoryStub
            ->shouldReceive('create')
            ->with($this->messageDTO, 'canhassi', $this->messageEntity->obtainedExperience)
            ->once()
            ->andReturn($this->messageEntity);

        $test = new PersistMessage($this->messageRepositoryStub);

        $test->handle($this->messageDTO, $this->messageEntity->obtainedExperience, 'canhassi');
    }
}
