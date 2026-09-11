<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\Workflow;
use App\Services\CortexAiService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Cortex Copilot™')]
class CopilotWorkspace extends Component
{
    public string $inputPrompt = '';
    public array $conversation = [];
    public bool $isThinking = false;
    public int $queriesUsedThisMonth = 3; // Simulated usage meter
    public ?array $pendingTaskDraft = null;

    public function mount(): void
    {
        $user = Auth::user();

        // Initial welcome message from Cortex Copilot
        $this->conversation[] = [
            'role' => 'assistant',
            'content' => "Hello **{$user->name}**, I'm **TaskVerge Cortex Copilot™**. I'm connected to your live pipelines, tasks, and telemetry. How can I assist your workflow operations today?",
            'source' => 'Cortex System Intelligence',
            'time' => now()->format('H:i'),
            'draft' => null,
        ];
    }

    public function sendMessage(): void
    {
        $prompt = trim($this->inputPrompt);
        if (empty($prompt)) {
            return;
        }

        $user = Auth::user();
        $limit = $user->getCopilotLimit();

        if ($limit !== null && $this->queriesUsedThisMonth >= $limit) {
            session()->flash('copilot_limit', "You have reached your {$limit} monthly queries limit on the " . $user->getPlanConfig()['label'] . " tier. Upgrade to Operations Core or Enterprise for higher limits.");
            return;
        }

        // Add user message to history
        $this->conversation[] = [
            'role' => 'user',
            'content' => $prompt,
            'source' => $user->name,
            'time' => now()->format('H:i'),
            'draft' => null,
        ];

        $this->inputPrompt = '';
        $this->isThinking = true;

        $ai = app(CortexAiService::class);
        $result = $ai->chatWithCopilot($this->conversation, $prompt, $user);

        $this->queriesUsedThisMonth++;
        $this->isThinking = false;

        $this->conversation[] = [
            'role' => 'assistant',
            'content' => $result['reply'],
            'source' => $result['source'] ?? 'Cortex Copilot',
            'time' => now()->format('H:i'),
            'draft' => $result['task_draft'] ?? null,
        ];

        if (!empty($result['task_draft'])) {
            $this->pendingTaskDraft = $result['task_draft'];
        }
    }

    public function sendPreset(string $preset): void
    {
        $this->inputPrompt = $preset;
        $this->sendMessage();
    }

    public function deployDraftTask(): void
    {
        if (!$this->pendingTaskDraft) {
            return;
        }

        $workflow = Workflow::first();
        if (!$workflow) {
            session()->flash('error', 'No workflow found to deploy task.');
            return;
        }

        $stage = $workflow->stages()->first();
        $lastId = Task::max('id') ?? 0;
        $taskNumber = 'TSK-' . str_pad((string) ($lastId + 1), 4, '0', STR_PAD_LEFT);

        $task = Task::create([
            'workflow_id' => $workflow->id,
            'stage_id' => $stage ? $stage->id : 1,
            'task_number' => $taskNumber,
            'title' => $this->pendingTaskDraft['title'] ?? 'Cortex Copilot Task',
            'description' => 'Synthesized and deployed via Cortex Copilot workspace prompt.',
            'priority' => $this->pendingTaskDraft['priority'] ?? 'high',
            'status' => 'active',
            'assigned_to' => Auth::id(),
            'created_by' => Auth::id(),
            'estimated_hours' => $this->pendingTaskDraft['estimated_hours'] ?? 4.0,
            'tags' => ['cortex-copilot', 'ai-generated'],
            'order_column' => 1,
        ]);

        $task->recordActivity(
            'created',
            'Task deployed from Cortex Copilot by ' . Auth::user()->name,
            ['source' => 'copilot']
        );

        $deployedTitle = $task->title;
        $this->pendingTaskDraft = null;

        $this->conversation[] = [
            'role' => 'assistant',
            'content' => "🚀 **Success!** Created task **{$task->task_number}: {$deployedTitle}** in the *{$workflow->title}* pipeline.",
            'source' => 'Cortex Execution Engine',
            'time' => now()->format('H:i'),
            'draft' => null,
        ];

        session()->flash('status', "Task {$task->task_number} deployed successfully.");
    }

    public function clearConversation(): void
    {
        $this->conversation = [];
        $this->mount();
        $this->pendingTaskDraft = null;
    }

    public function render()
    {
        $user = Auth::user();
        $limit = $user->getCopilotLimit();
        $planConfig = $user->getPlanConfig();

        return view('livewire.copilot-workspace', [
            'user' => $user,
            'limit' => $limit,
            'planConfig' => $planConfig,
        ]);
    }
}
