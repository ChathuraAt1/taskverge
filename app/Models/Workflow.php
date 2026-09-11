<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workflow extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'department',
        'status',
        'owner_id',
        'color',
        'is_starred',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_starred' => 'boolean',
        ];
    }

    /**
     * The user who owns/administers this workflow.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * The ordered stages defined for this workflow.
     */
    public function stages(): HasMany
    {
        return $this->hasMany(WorkflowStage::class)->orderBy('order');
    }

    /**
     * All tasks belonging to this workflow.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Terminal / completed stage for this workflow.
     */
    public function completedStage(): ?WorkflowStage
    {
        return $this->stages()->where('is_terminal_success', true)->first();
    }

    /**
     * Calculate workflow progress percentage (0 - 100%).
     */
    public function getProgressPercentageAttribute(): int
    {
        $total = $this->tasks()->count();
        if ($total === 0) {
            return 0;
        }

        $completed = $this->tasks()->where('status', 'completed')->count();

        return (int) round(($completed / $total) * 100);
    }

    /**
     * Active tasks count.
     */
    public function getActiveTasksCountAttribute(): int
    {
        return $this->tasks()->where('status', 'active')->count();
    }

    /**
     * Blocked tasks count.
     */
    public function getBlockedTasksCountAttribute(): int
    {
        return $this->tasks()->where('status', 'blocked')->count();
    }

    /**
     * Overdue tasks count.
     */
    public function getOverdueTasksCountAttribute(): int
    {
        return $this->tasks()
            ->where('status', '!=', 'completed')
            ->whereNotNull('deadline')
            ->where('deadline', '<', now())
            ->count();
    }
}
