<?php

namespace He4rt\Message\Providers;

use He4rt\Message\Repositories\MessageRepository;
use He4rt\Message\Repositories\VoiceRepository;
use He4rt\Message\Repositories\MessageEloquentRepository;
use He4rt\Message\Repositories\VoiceEloquentRepository;
use Illuminate\Support\ServiceProvider;

class MessageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register repository bindings
        $this->app->bind(MessageRepository::class, MessageEloquentRepository::class);
        $this->app->bind(VoiceRepository::class, VoiceEloquentRepository::class);
    }

    public function boot(): void
    {
        // Load routes
        $this->loadRoutesFrom(__DIR__ . '/../../routes/message-routes.php');
    }
}