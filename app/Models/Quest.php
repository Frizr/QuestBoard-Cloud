<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quest extends Model
{
    use HasFactory;

    public const DIFFICULTIES = [
        'easy' => 'Easy',
        'normal' => 'Normal',
        'hard' => 'Hard',
        'epic' => 'Epic',
        'boss' => 'Boss Quest',
    ];

    public const STATUSES = [
        'pending' => 'Pending',
        'in_progress' => 'In Progress',
        'completed' => 'Completed',
    ];

    public const EXP_REWARDS = [
        'easy' => 50,
        'normal' => 100,
        'hard' => 200,
        'epic' => 350,
        'boss' => 500,
    ];

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'difficulty',
        'status',
        'reward_exp',
        'deadline',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public static function rewardForDifficulty(string $difficulty): int
    {
        return self::EXP_REWARDS[$difficulty] ?? 0;
    }

    public function isOverdue(): bool
    {
        return $this->status !== 'completed'
            && $this->deadline !== null
            && $this->deadline->isPast();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
