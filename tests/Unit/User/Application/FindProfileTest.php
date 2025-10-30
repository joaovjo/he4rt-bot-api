<?php

declare(strict_types=1);

namespace Tests\Unit\User\Application;

use Heart\Provider\Domain\Entities\ProviderEntity;
use Heart\Provider\Domain\Repositories\ProviderRepository;
use Heart\User\Application\Exceptions\ProfileException;
use Heart\User\Application\FindProfile;
use Heart\User\Domain\Actions\GetProfile;
use Heart\User\Domain\Entities\ProfileEntity;
use Heart\User\Domain\Entities\UserEntity;
use Heart\User\Domain\Repositories\UserRepository;
use Mockery as m;
use Mockery\MockInterface;
use Tests\TestCase;
use Tests\Unit\Character\ProviderProviderTrait;
use Tests\Unit\User\ProfileProviderTrait;
use Tests\Unit\User\UserProviderTrait;

final class FindProfileTest extends TestCase
{
    use ProfileProviderTrait;
    use ProviderProviderTrait;
    use UserProviderTrait;

    private MockInterface $userRepositoryStub;

    private MockInterface $getProfileStub;

    private MockInterface $providerRepositoryStub;

    private UserEntity $userEntity;

    private ProviderEntity $providerEntity;

    private ProfileEntity $profileEntity;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRepositoryStub = m::mock(UserRepository::class);
        $this->getProfileStub = m::mock(GetProfile::class);
        $this->providerRepositoryStub = m::mock(ProviderRepository::class);
        $this->providerEntity = $this->validProviderEntity();
        $this->userEntity = $this->validUserEntity();
        $this->profileEntity = $this->validProfileEntity();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        m::close();
    }

    public function test_find_profile_with_username_success(): void
    {
        $this->userRepositoryStub
            ->shouldReceive('findByUsername')
            ->with('canhassi')
            ->once()
            ->andReturn($this->userEntity);

        $this->getProfileStub
            ->shouldReceive('handle')
            ->with($this->userEntity->id)
            ->once()
            ->andReturn($this->profileEntity);

        $test = new FindProfile($this->getProfileStub, $this->userRepositoryStub, $this->providerRepositoryStub);

        $test->handle('canhassi');
    }

    public function test_find_profile_with_provider_id_success(): void
    {
        $this->userRepositoryStub
            ->shouldReceive('findByUsername')
            ->with('canhassi-id')
            ->once();

        $this->providerRepositoryStub
            ->shouldReceive('findByProviderId')
            ->with('canhassi-id')
            ->once()
            ->andReturn($this->providerEntity);

        $this->getProfileStub
            ->shouldReceive('handle')
            ->with($this->providerEntity->userId)
            ->once()
            ->andReturn($this->profileEntity);

        $test = new FindProfile($this->getProfileStub, $this->userRepositoryStub, $this->providerRepositoryStub);

        $test->handle('canhassi-id');
    }

    public function test_profile_not_found(): void
    {
        $this->expectException(ProfileException::class);

        $this->userRepositoryStub
            ->shouldReceive('findByUsername')
            ->with('canhassi-id')
            ->once();

        $this->providerRepositoryStub
            ->shouldReceive('findByProviderId')
            ->with('canhassi-id')
            ->once();

        $test = new FindProfile($this->getProfileStub, $this->userRepositoryStub, $this->providerRepositoryStub);

        $test->handle('canhassi-id');
    }
}
