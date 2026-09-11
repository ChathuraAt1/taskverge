<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\TaskActivity;
use App\Models\User;
use App\Models\Workflow;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\StreamedResponse;

#[Layout('layouts.app')]
#[Title('Compliance Audit Log')]
class AuditLog extends Component
{
    use WithPagination;

    public string $actionFilter = 'all';
    public string $userFilter = 'all';
    public string $workflowFilter = 'all';

    public function updatedActionFilter(): void
    {
        $this->resetPage();
    }

    public function updatedUserFilter(): void
    {
        $this->resetPage();
    }

    public function updatedWorkflowFilter(): void
    {
        $this->resetPage();
    }

    /**
     * Streamed CSV export of audit records.
     */
    public function exportCsv(): StreamedResponse
    {
        $user = Auth::user();
        $retentionDays = $user->getAuditRetentionDays();
        $startDate = $retentionDays ? now()->subDays($retentionDays) : now()->subYears(5);

        $activities = TaskActivity::with(['task.workflow', 'user'])
            ->where('created_at', '>=', $startDate)
            ->latest('created_at')
            ->get();

        $fileName = 'taskverge-audit-log-' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$fileName}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return response()->stream(function () use ($activities) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Timestamp', 'Task Number', 'Task Title', 'Workflow', 'Action', 'Description', 'Actor', 'Actor Email']);

            foreach ($activities as $act) {
                fputcsv($handle, [
                    $act->created_at->toIso8601String(),
                    $act->task?->task_number ?? 'N/A',
                    $act->task?->title ?? 'N/A',
                    $act->task?->workflow?->title ?? 'N/A',
                    $act->action,
                    $act->description,
                    $act->user?->name ?? 'System',
                    $act->user?->email ?? 'system@taskverge.com',
                ]);
            }

            fclose($handle);
        }, 200, $headers);
    }

    public function render()
    {
        $user = Auth::user();
        $planConfig = $user->getPlanConfig();
        $retentionDays = $user->getAuditRetentionDays();
        $startDate = $retentionDays ? now()->subDays($retentionDays) : now()->subYears(5);

        $query = TaskActivity::with(['task.workflow', 'user'])
            ->where('created_at', '>=', $startDate);

        if ($this->actionFilter !== 'all') {
            $query->where('action', $this->actionFilter);
        }

        if ($this->userFilter !== 'all') {
            $query->where('user_id', $this->userFilter);
        }

        if ($this->workflowFilter !== 'all') {
            $query->whereHas('task', function ($q) {
                $q->where('workflow_id', $this->workflowFilter);
            });
        }

        $activities = $query->latest('created_at')->paginate(15);
        $users = User::where('is_active', true)->get();
        $workflows = Workflow::all();

        return view('livewire.audit-log', [
            'activities' => $activities,
            'users' => $users,
            'workflows' => $workflows,
            'planConfig' => $planConfig,
            'retentionDays' => $retentionDays,
        ]);
    }
}
