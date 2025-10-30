<?php

declare(strict_types=1);

namespace Heart\Character\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $character_id
 * @property int $balance
 */
final class Wallet extends Model
{
    protected $table = 'character_wallet';

    protected $fillable = [
        'character_id',
        'balance',
    ];

    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }
}
