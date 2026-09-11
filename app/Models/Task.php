<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'workflow_id',
        'stage_id',
        'task_number',
        'title',
        'description',
        'priority',
        'status',
        'deadline',
        'assigned_to',
        'created_by',
        'blocked_reason',
        'estimated_hours',
        'actual_hours',
        'tags',
        'order_column',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'deadline' => 'datetime',
            'tags' => 'array',
            'estimated_hours' => 'float',
            'actual_hours' => 'float',
            'order_column' => 'integer',
        ];
    }

    /**
     * Workflow relationship.
     */
    public function workflow(): BelongsTo
    {
        return $this->belongsTo(Workflow::class);
    }

    /**
     * Workflow stage relationship.
     */
    public function stage(): BelongsTo
    {
        return $this->belongsTo(WorkflowStage::class, 'stage_id');
    }

    /**
     * Assigned user relationship.
     */
    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Task creator relationship.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Immutable audit activities for this task.
     */
    public function activities(): HasMany
    {
        return $this->hasMany(TaskActivity::class)->latest('created_at');
    }

    /**
     * Record an audit activity for this task.
     */
    public function recordActivity(string $action, string $description, ?array $details = null, ?User $user = null): TaskActivity
    {
        return $this->activities()->create([
            'user_id' => $user ? $user->id : Auth::id(),
            'action' => $action,
            'description' => $description,
            'details' => $details,
            'created_at' => now(),
        ]);
    }

    /**
     * Check if task is overdue.
     */
    public function isOverdue(): bool
    {
        return $this->status !== 'completed' && $this->deadline && $this->deadline->isPast();
    }

    /**
     * Check if task is blocked.
     */
    public function isBlocked(): bool
    {
        return $this->status === 'blocked';
    }

    /**
     * Check if task is completed.
     */
    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Scope for overdue tasks.
     */
    public function scopeOverdue(Builder $query): Builder
    {
        return $query->where('status', '!=', 'completed')
            ->whereNotNull('deadline')
            ->where('deadline', '<', now());
    }

    /**
     * Scope for blocked tasks.
     */
    public function scopeBlocked(Builder $query): Builder
    {
        return $query->where('status', 'blocked');
    }

    /**
     * Scope for active tasks.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }
}
