<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkflowStage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'workflow_id',
        'name',
        'slug',
        'order',
        'color',
        'is_terminal_success',
        'is_blocked_stage',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'order' => 'integer',
            'is_terminal_success' => 'boolean',
            'is_blocked_stage' => 'boolean',
        ];
    }

    /**
     * Parent workflow.
     */
    public function workflow(): BelongsTo
    {
        return $this->belongsTo(Workflow::class);
    }

    /**
     * Tasks currently at this stage.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'stage_id')->orderBy('order_column');
    }
}
