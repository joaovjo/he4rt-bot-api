<?php

declare(strict_types=1);

namespace Heart\Character\Infrastructure\Models;

use Heart\Character\Infrastructure\Factories\PastSeasonFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class PastSeason extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'seasons_rankings';

    protected $fillable = [
        'season_id',
        'character_id',
        'ranking_position',
        'experience',
        'messages_count',
        'badges_count',
        'meetings_count',
    ];

    protected static function newFactory(): PastSeasonFactory
    {
        return PastSeasonFactory::new();
    }
}
