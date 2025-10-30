<?php

declare(strict_types=1);

use Heart\Meeting\Infrastructure\Models\MeetingType;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        MeetingType::query()->create([
            'name' => 'Reunião Semanal',
            'week_day' => 1,
            'start_at' => 1320,
        ]);

        MeetingType::query()->create([
            'name' => 'Reunião das Primas',
            'week_day' => 2,
            'start_at' => 1200,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        MeetingType::query()->whereIn('name', ['Reunião Semanal', 'Reunião das Primas'])->forceDelete();
    }
};
