<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\Workflow;
use App\Models\WorkflowStage;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Analytics & SLA Telemetry')]
class AnalyticsDashboard extends Component
{
    public string $timeRange = '30d'; // 7d, 30d, 90d

    public function setRange(string $range): void
    {
        $user = Auth::user();
        $allowedDays = $user->getAnalyticsHistoryDays();

        if ($allowedDays !== null && $allowedDays < 30 && ($range === '30d' || $range === '90d')) {
            session()->flash('analytics_gate', "Your {$user->getPlanConfig()['label']} includes 7 days of telemetry retention. Upgrade to Operations Core or Enterprise for 90-day and unlimited historical analytics.");
            $this->timeRange = '7d';
            return;
        }

        $this->timeRange = $range;
    }

    public function render()
    {
        $user = Auth::user();
        $days = match ($this->timeRange) {
            '7d' => 7,
            '90d' => 90,
            default => 30,
        };

        $startDate = now()->subDays($days);

        // 1. Overall Completion & On-Time Rate
        $completedTasks = Task::where('status', 'completed')
            ->where('updated_at', '>=', $startDate)
            ->get();

        $totalCompleted = $completedTasks->count();
        $onTimeCompleted = $completedTasks->filter(function ($t) {
            return !$t->deadline || $t->updated_at <= $t->deadline;
        })->count();

        $onTimeRate = $totalCompleted > 0 ? (int) round(($onTimeCompleted / $totalCompleted) * 100) : 100;

        // 2. Average Cycle Time (days from created_at to updated_at)
        $cycleDays = $completedTasks->map(function ($t) {
            return max(0.5, $t->created_at->diffInDays($t->updated_at) ?: 1);
        });
        $avgCycleDays = $cycleDays->count() > 0 ? round($cycleDays->average(), 1) : 2.4;

        // 3. Bottleneck Exposure (% of tasks currently or historically blocked)
        $totalWindowTasks = Task::where('created_at', '>=', $startDate)->count();
        $blockedWindowTasks = Task::where('created_at', '>=', $startDate)
            ->where(function ($q) {
                $q->where('status', 'blocked')
                  ->orWhereNotNull('blocked_reason');
            })->count();
        $bottleneckRate = $totalWindowTasks > 0 ? (int) round(($blockedWindowTasks / $totalWindowTasks) * 100) : 12;

        // 4. Workflow Performance Breakdown
        $workflows = Workflow::with(['stages', 'tasks'])
            ->get()
            ->map(function ($wf) {
                $total = $wf->tasks->count();
                $completed = $wf->tasks->where('status', 'completed')->count();
                $blocked = $wf->tasks->where('status', 'blocked')->count();
                $active = $wf->tasks->whereIn('status', ['active', 'pending'])->count();
                $completionPercent = $total > 0 ? (int) round(($completed / $total) * 100) : 0;

                return [
                    'id' => $wf->id,
                    'title' => $wf->title,
                    'department' => $wf->department,
                    'color' => $wf->color,
                    'total' => $total,
                    'completed' => $completed,
                    'blocked' => $blocked,
                    'active' => $active,
                    'completion_percent' => $completionPercent,
                ];
            });

        // 5. Department Throughput Distribution
        $departmentDistribution = Task::where('tasks.created_at', '>=', $startDate)
            ->join('workflows', 'tasks.workflow_id', '=', 'workflows.id')
            ->selectRaw('workflows.department, count(*) as count')
            ->groupBy('workflows.department')
            ->pluck('count', 'workflows.department')
            ->toArray();

        return view('livewire.analytics-dashboard', [
            'user' => $user,
            'planConfig' => $user->getPlanConfig(),
            'totalCompleted' => $totalCompleted,
            'onTimeRate' => $onTimeRate,
            'avgCycleDays' => $avgCycleDays,
            'bottleneckRate' => $bottleneckRate,
            'workflows' => $workflows,
            'departmentDistribution' => $departmentDistribution,
            'totalWindowTasks' => $totalWindowTasks,
        ]);
    }
}
