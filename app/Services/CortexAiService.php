<?php

namespace App\Services;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CortexAiService
{
    /**
     * Analyze a task title & description to suggest priority, estimated hours, and tags.
     */
    public function suggestTriage(string $title, ?string $description = null): array
    {
        $apiKey = config('ai.api_key');
        $endpoint = rtrim(config('ai.endpoint', 'https://api.groq.com/openai/v1'), '/');
        $model = config('ai.model', 'llama-3.3-70b-versatile');

        if (!empty($apiKey)) {
            try {
                $response = Http::timeout(config('ai.timeout', 15))
                    ->withToken($apiKey)
                    ->post("{$endpoint}/chat/completions", [
                        'model' => $model,
                        'messages' => [
                            [
                                'role' => 'system',
                                'content' => "You are TaskVerge Cortex AI, an enterprise workflow intelligence engine. Analyze the task and return ONLY a strict JSON object with these exact keys: 'priority' (one of: 'critical', 'high', 'medium', 'low'), 'estimated_hours' (number between 1 and 40), 'suggested_tags' (array of 1 to 3 short lowercase strings), and 'reasoning' (one sentence explaining the triage). Do not wrap in markdown code blocks.",
                            ],
                            [
                                'role' => 'user',
                                'content' => "Task Title: {$title}\nDescription: " . ($description ?? 'None provided'),
                            ],
                        ],
                        'temperature' => 0.2,
                        'max_tokens' => 300,
                    ]);

                if ($response->successful()) {
                    $raw = trim($response->json('choices.0.message.content', ''));
                    // Strip potential markdown backticks
                    $cleanJson = preg_replace('/^```json\s*|\s*```$/i', '', $raw);
                    $decoded = json_decode($cleanJson, true);

                    if (is_array($decoded) && isset($decoded['priority'])) {
                        $priority = in_array(strtolower($decoded['priority']), ['critical', 'high', 'medium', 'low'])
                            ? strtolower($decoded['priority'])
                            : 'medium';

                        return [
                            'priority' => $priority,
                            'estimated_hours' => (float) ($decoded['estimated_hours'] ?? 4.0),
                            'suggested_tags' => array_slice((array) ($decoded['suggested_tags'] ?? ['triage']), 0, 3),
                            'reasoning' => $decoded['reasoning'] ?? 'Categorized via Cortex AI reasoning model.',
                            'source' => 'Cortex AI (' . $model . ')',
                        ];
                    }
                }
            } catch (\Throwable $e) {
                Log::warning('Cortex AI triage endpoint error: ' . $e->getMessage());
            }
        }

        // Deterministic heuristic fallback
        return $this->heuristicTriage($title, $description);
    }

    /**
     * Analyze a blocked task and generate intelligent unblocking recommendations.
     */
    public function analyzeBlocker(Task $task): array
    {
        $apiKey = config('ai.api_key');
        $endpoint = rtrim(config('ai.endpoint', 'https://api.groq.com/openai/v1'), '/');
        $model = config('ai.model', 'llama-3.3-70b-versatile');

        $reason = $task->blocked_reason ?: 'No explicit blocker reason logged.';

        if (!empty($apiKey)) {
            try {
                $response = Http::timeout(config('ai.timeout', 15))
                    ->withToken($apiKey)
                    ->post("{$endpoint}/chat/completions", [
                        'model' => $model,
                        'messages' => [
                            [
                                'role' => 'system',
                                'content' => "You are TaskVerge Cortex AI. Analyze this blocked task. Return ONLY a strict JSON object with keys: 'root_cause' (one short phrase), 'recommendation' (concise 1-2 sentence actionable resolution), 'urgency' ('Critical' or 'Moderate'), 'action_label' (2-4 words for the action button). Do not wrap in markdown code blocks.",
                            ],
                            [
                                'role' => 'user',
                                'content' => "Task: {$task->title}\nWorkflow: " . ($task->workflow?->name ?? 'General') . "\nStage: " . ($task->stage?->name ?? 'Unknown') . "\nBlocked Reason: {$reason}\nPriority: {$task->priority}",
                            ],
                        ],
                        'temperature' => 0.2,
                        'max_tokens' => 300,
                    ]);

                if ($response->successful()) {
                    $raw = trim($response->json('choices.0.message.content', ''));
                    $cleanJson = preg_replace('/^```json\s*|\s*```$/i', '', $raw);
                    $decoded = json_decode($cleanJson, true);

                    if (is_array($decoded) && isset($decoded['recommendation'])) {
                        return [
                            'root_cause' => $decoded['root_cause'] ?? 'Stage Dependency Stall',
                            'recommendation' => $decoded['recommendation'],
                            'urgency' => $decoded['urgency'] ?? ($task->priority === 'critical' ? 'Critical' : 'Moderate'),
                            'action_label' => $decoded['action_label'] ?? '1-Click Unblock',
                            'source' => 'Cortex AI (' . $model . ')',
                        ];
                    }
                }
            } catch (\Throwable $e) {
                Log::warning('Cortex AI blocker analysis error: ' . $e->getMessage());
            }
        }

        // Heuristic fallback
        return [
            'root_cause' => 'Inter-Stage Bottleneck',
            'recommendation' => "Task is held on '{$reason}'. Recommend re-routing to an active operational stage or reassigning to available team capacity.",
            'urgency' => ($task->priority === 'critical' || $task->isOverdue()) ? 'Critical' : 'Moderate',
            'action_label' => 'Execute 1-Click Unblock',
            'source' => 'Cortex Heuristic Radar',
        ];
    }

    /**
     * Synthesize a structured daily standup report in Markdown format.
     */
    public function generateStandupSummary(User $user, Collection $activeTasks, Collection $completedTasks, Collection $blockedTasks): string
    {
        $apiKey = config('ai.api_key');
        $endpoint = rtrim(config('ai.endpoint', 'https://api.groq.com/openai/v1'), '/');
        $model = config('ai.model', 'llama-3.3-70b-versatile');

        $completedTitles = $completedTasks->pluck('title')->implode(', ') ?: 'None';
        $activeTitles = $activeTasks->pluck('title')->implode(', ') ?: 'None';
        $blockedTitles = $blockedTasks->map(fn($t) => "{$t->title} (" . ($t->blocked_reason ?: 'Stalled') . ")")->implode('; ') ?: 'None';

        if (!empty($apiKey)) {
            try {
                $response = Http::timeout(config('ai.timeout', 15))
                    ->withToken($apiKey)
                    ->post("{$endpoint}/chat/completions", [
                        'model' => $model,
                        'messages' => [
                            [
                                'role' => 'system',
                                'content' => "You are TaskVerge Cortex AI. Generate an executive daily standup report formatted in Markdown for Slack/Teams. Use standard headings: '### 🎯 Completed Recently', '### 🚀 In Progress (Focus Today)', '### ⚠️ Blockers & Risks', and a brief closing 1-sentence velocity summary. Be crisp, professional, and concise.",
                            ],
                            [
                                'role' => 'user',
                                'content' => "User: {$user->name} ({$user->title})\nDepartment: {$user->department}\nCompleted Tasks: {$completedTitles}\nActive Tasks: {$activeTitles}\nBlocked Tasks: {$blockedTitles}",
                            ],
                        ],
                        'temperature' => 0.3,
                        'max_tokens' => 500,
                    ]);

                if ($response->successful()) {
                    $content = trim($response->json('choices.0.message.content', ''));
                    if (!empty($content)) {
                        return $content;
                    }
                }
            } catch (\Throwable $e) {
                Log::warning('Cortex AI standup generation error: ' . $e->getMessage());
            }
        }

        // Heuristic fallback report
        $md = "## 📋 Daily Standup — {$user->name}\n";
        $md .= "*Generated on " . now()->format('l, F j, Y') . "*\n\n";

        $md .= "### 🎯 Completed Recently (" . $completedTasks->count() . ")\n";
        if ($completedTasks->isEmpty()) {
            $md .= "- *No tasks completed in the last 7 days.*\n";
        } else {
            foreach ($completedTasks as $t) {
                $md .= "- **{$t->task_number}**: {$t->title} `[" . ($t->workflow?->name ?? 'General') . "]`\n";
            }
        }

        $md .= "\n### 🚀 In Progress / Focus Today (" . $activeTasks->count() . ")\n";
        if ($activeTasks->isEmpty()) {
            $md .= "- *All active tasks cleared. Ready for new queue intake.*\n";
        } else {
            foreach ($activeTasks->take(6) as $t) {
                $due = $t->deadline ? " (Due " . $t->deadline->format('M j') . ")" : "";
                $md .= "- **{$t->task_number}**: {$t->title} `[" . strtoupper($t->priority) . "]`{$due}\n";
            }
        }

        $md .= "\n### ⚠️ Blockers & Needs Attention (" . $blockedTasks->count() . ")\n";
        if ($blockedTasks->isEmpty()) {
            $md .= "- *Zero active blockers detected across workflows.*\n";
        } else {
            foreach ($blockedTasks as $t) {
                $md .= "- **{$t->task_number}**: {$t->title} — **Reason:** " . ($t->blocked_reason ?: 'Stalled in stage') . "\n";
            }
        }

        return $md;
    }

    /**
     * Intelligent local heuristic triage when remote AI is unavailable.
     */
    protected function heuristicTriage(string $title, ?string $description): array
    {
        $text = strtolower($title . ' ' . ($description ?? ''));

        $priority = 'medium';
        $hours = 4.0;
        $tags = ['operations'];

        if (preg_match('/(outage|down|crash|security|critical|vulnerability|exploit|p0|urgent|emergency|breach)/i', $text)) {
            $priority = 'critical';
            $hours = 6.0;
            $tags = ['security', 'urgent'];
        } elseif (preg_match('/(bug|error|fail|broken|blocker|impediment|warning|compliance|audit|payment|stripe)/i', $text)) {
            $priority = 'high';
            $hours = 8.0;
            $tags = ['high-priority', 'compliance'];
        } elseif (preg_match('/(document|readme|clean|minor|typo|comment|tweak|cosmetic)/i', $text)) {
            $priority = 'low';
            $hours = 2.0;
            $tags = ['docs', 'maintenance'];
        }

        return [
            'priority' => $priority,
            'estimated_hours' => $hours,
            'suggested_tags' => $tags,
            'reasoning' => "Analyzed via Cortex heuristic radar based on domain operational keywords.",
            'source' => 'Cortex Heuristic Radar',
        ];
    }

    /**
     * Chat with Cortex Copilot using live enterprise workflow intelligence context.
     */
    public function chatWithCopilot(array $history, string $userMessage, User $user): array
    {
        $apiKey = config('ai.api_key');
        $endpoint = rtrim(config('ai.endpoint', 'https://api.groq.com/openai/v1'), '/');
        $model = config('ai.model', 'llama-3.3-70b-versatile');

        // Compile live system context
        $blockedTasks = Task::with('workflow')->where('status', 'blocked')->take(5)->get();
        $myActiveTasks = Task::with(['workflow', 'stage'])->where('assigned_to', $user->id)->whereIn('status', ['active', 'pending'])->take(5)->get();
        $overdueCount = Task::where('assigned_to', $user->id)->where('status', '!=', 'completed')->whereNotNull('deadline')->where('deadline', '<', now())->count();
        $activeWorkflows = \App\Models\Workflow::where('status', 'active')->pluck('title')->take(5)->toArray();

        $contextSummary = "User: {$user->name} ({$user->role}, Dept: " . ($user->department ?? 'General') . ")\n";
        $contextSummary .= "Active Workflows: " . implode(', ', $activeWorkflows) . "\n";
        $contextSummary .= "User Active Tasks Count: " . $myActiveTasks->count() . ", Overdue Count: {$overdueCount}\n";
        $contextSummary .= "System Blocked Tasks (" . $blockedTasks->count() . " total):\n";
        foreach ($blockedTasks as $bt) {
            $contextSummary .= "- {$bt->task_number}: {$bt->title} (Reason: " . ($bt->blocked_reason ?: 'Unknown') . ")\n";
        }

        if (!empty($apiKey)) {
            try {
                $messages = [
                    [
                        'role' => 'system',
                        'content' => "You are TaskVerge Cortex Copilot™, an enterprise AI workflow intelligence assistant. You help teams manage tasks, unblock stalled workflows, predict SLA risks, draft action items, and optimize operational velocity.\n\nUse clear markdown, bullet points, and bold text. If the user asks to draft or create a task, provide a clear structured proposal with Title, Priority, Estimated Hours, and Department.\n\nLIVE CONTEXT:\n{$contextSummary}",
                    ],
                ];

                foreach (array_slice($history, -6) as $msg) {
                    if (isset($msg['role'], $msg['content'])) {
                        $messages[] = [
                            'role' => $msg['role'] === 'user' ? 'user' : 'assistant',
                            'content' => (string) $msg['content'],
                        ];
                    }
                }

                $messages[] = [
                    'role' => 'user',
                    'content' => $userMessage,
                ];

                $response = Http::timeout(config('ai.timeout', 20))
                    ->withToken($apiKey)
                    ->post("{$endpoint}/chat/completions", [
                        'model' => $model,
                        'messages' => $messages,
                        'temperature' => 0.4,
                        'max_tokens' => 600,
                    ]);

                if ($response->successful()) {
                    $reply = trim($response->json('choices.0.message.content', ''));
                    if (!empty($reply)) {
                        return [
                            'reply' => $reply,
                            'source' => 'Cortex AI (' . $model . ')',
                            'task_draft' => $this->extractTaskDraft($userMessage, $reply),
                        ];
                    }
                }
            } catch (\Throwable $e) {
                Log::warning('Cortex Copilot chat error: ' . $e->getMessage());
            }
        }

        return $this->heuristicCopilotReply($userMessage, $user, $blockedTasks, $myActiveTasks, $overdueCount);
    }

    /**
     * Local heuristic Copilot response when remote LLM endpoint is not configured.
     */
    protected function heuristicCopilotReply(string $userMessage, User $user, Collection $blockedTasks, Collection $myActiveTasks, int $overdueCount): array
    {
        $msg = strtolower($userMessage);
        $taskDraft = null;

        if (preg_match('/(block|stuck|stalled|impediment)/i', $msg)) {
            if ($blockedTasks->isEmpty()) {
                $reply = "### ✅ Zero Blockers Detected\n\nAll current operational workflows are progressing smoothly. No tasks are currently marked as blocked across active pipelines.";
            } else {
                $reply = "### ⚠️ Active Workflow Blockers ({$blockedTasks->count()})\n\nI have identified the following tasks requiring immediate unblocking intervention:\n\n";
                foreach ($blockedTasks as $t) {
                    $reply .= "- **{$t->task_number}**: {$t->title}\n  - *Reason:* " . ($t->blocked_reason ?: 'Awaiting upstream dependency') . "\n  - *Recommendation:* Check stage requirements or use 1-Click Unblock on Dashboard.\n";
                }
            }
        } elseif (preg_match('/(sla|deadline|overdue|risk)/i', $msg)) {
            $reply = "### ⏱️ SLA Risk & Deadline Analysis\n\n- **Overdue Items:** {$overdueCount} tasks past deadline.\n- **Personal Active Workload:** {$myActiveTasks->count()} tasks assigned to you.\n- **Recommendation:** Focus on high-urgency milestones first to maintain your team's on-time SLA target.";
        } elseif (preg_match('/(draft|create|new task|assign)/i', $msg)) {
            $title = 'Optimized workflow execution milestone';
            if (preg_match('/(?:draft|create|add)\s+(?:a\s+)?(?:task|ticket)?\s*(?:for|to|about)?\s*(.+)/i', $userMessage, $matches)) {
                $title = ucfirst(trim($matches[1], " .!?"));
            }
            $taskDraft = [
                'title' => $title,
                'priority' => 'high',
                'estimated_hours' => 4.0,
            ];
            $reply = "### 📋 Task Draft Prepared\n\nI have structured a new operational task based on your prompt:\n\n- **Title:** {$title}\n- **Priority:** High\n- **Estimated Effort:** 4.0 hours\n\nClick **\"Create This Task\"** below to instantly deploy it into your active workflow.";
        } elseif (preg_match('/(status|summary|standup|today)/i', $msg)) {
            $reply = "### 📊 Status Overview for {$user->name}\n\n- **Active Work items:** {$myActiveTasks->count()} tasks assigned\n- **Overdue Alerts:** {$overdueCount} items\n- **System Status:** Enterprise workflows operating at nominal throughput.\n\nAsk me to unblock items, analyze deadlines, or draft follow-up tasks!";
        } else {
            $reply = "### 🤖 TaskVerge Cortex Copilot™\n\nI am connected to your live workflow telemetry. Here is what I can assist you with right now:\n\n1. **Unblock Pipelines:** Ask *\"What tasks are blocked?\"* to review impediments.\n2. **SLA & Deadlines:** Ask *\"Which tasks are near deadline?\"* for risk forecasting.\n3. **Draft Tasks:** Say *\"Draft a task to calibrate inference cluster\"* for 1-click intake.\n4. **Workload Analysis:** Inquire about department capacity and assignment balance.";
        }

        return [
            'reply' => $reply,
            'source' => 'Cortex Intelligence Engine',
            'task_draft' => $taskDraft,
        ];
    }

    /**
     * Attempt to extract a proposed task draft from conversational output.
     */
    protected function extractTaskDraft(string $userPrompt, string $aiReply): ?array
    {
        if (preg_match('/(?:draft|create|add)\s+(?:a\s+)?(?:task|ticket)?\s*(?:for|to|about)?\s*(.+)/i', $userPrompt, $matches)) {
            return [
                'title' => ucfirst(trim($matches[1], " .!?\n")),
                'priority' => 'high',
                'estimated_hours' => 4.0,
            ];
        }
        return null;
    }
}

