<?php

namespace He4rt\Message\Models;

use He4rt\Message\Database\Factories\MessageFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'messages';

    protected $fillable = [
        'id',
        'provider_id',
        'provider_message_id',
        'season_id',
        'channel_id',
        'content',
        'sent_at',
        'obtained_experience',
    ];

    protected static function newFactory(): MessageFactory
    {
        return MessageFactory::new();
    }
}