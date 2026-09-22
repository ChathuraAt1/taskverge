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
        $apiKey = config('ai.api_key') ?: env('AI_API_KEY');
        $endpoint = rtrim(config('ai.endpoint', 'https://api.groq.com/openai/v1'), '/');
        $model = config('ai.model', 'openai/gpt-oss-120b');

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
                } else {
                    Log::warning("Cortex AI triage HTTP error [{$response->status()}]: " . $response->body());
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
        $apiKey = config('ai.api_key') ?: env('AI_API_KEY');
        $endpoint = rtrim(config('ai.endpoint', 'https://api.groq.com/openai/v1'), '/');
        $model = config('ai.model', 'openai/gpt-oss-120b');

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
                } else {
                    Log::warning("Cortex AI blocker analysis HTTP error [{$response->status()}]: " . $response->body());
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
        $apiKey = config('ai.api_key') ?: env('AI_API_KEY');
        $endpoint = rtrim(config('ai.endpoint', 'https://api.groq.com/openai/v1'), '/');
        $model = config('ai.model', 'openai/gpt-oss-120b');

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
                } else {
                    Log::warning("Cortex AI standup generation HTTP error [{$response->status()}]: " . $response->body());
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

    /**
     * Public AI chat for landing page visitors with product, capability, pricing, and contact knowledge.
     */
    public function chatWithLandingVisitor(array $history, string $userMessage): array
    {
        $apiKey = config('ai.api_key') ?: env('AI_API_KEY');
        $endpoint = rtrim(config('ai.endpoint', 'https://api.groq.com/openai/v1'), '/');
        $model = config('ai.model', 'openai/gpt-oss-120b');

        $systemPrompt = <<<SYS
You are the official TaskVerge AI Assistant on taskverge.net.
TaskVerge is an enterprise Autonomous Task & Workflow Intelligence platform that eliminates operational coordination drag.

Key Knowledge Base:
- Core Capabilities: Autonomous stage transitions, proactive 48h SLA radar, real-time workload balancing guard, interactive Kanban workspaces, automated bottleneck unblocking, enterprise audit trails.
- Cortex AI Architecture: Powered by accelerated inference for automated task triage, blocker diagnosis, and natural language Copilot orchestration.
- Pricing Tiers:
  * Free Trial: 14 days full evaluation, 1 active pipeline, 3 team seats, up to 50 active tasks.
  * Operations Core ($49/month): 5 operational pipelines, 15 team seats, proactive SLA alerts, automated task triage.
  * Enterprise Intelligence ($199/month): Unlimited pipelines & seats, dedicated Cortex Copilot, custom webhook connectors, SOC2 audit logging, 99.99% SLA.
- Company & Locations:
  * Head Office: Taskverge PVT LTD, 165/7 Pickerings Road, Colombo 01500, Sri Lanka (Phone: +94717285555)
  * USA Branch Office: Taskverge LLC, 255 Ferry Blvd, Stratford, CT 06615, United States (Phone: +12038708505)
  * Support Email: help@taskverge.net
- Instructions:
  * Do NOT use emojis in your responses. Maintain a clean, crisp, and professional corporate tone.
  * Keep responses concise (1-3 short paragraphs or bullet points).
  * Use clean markdown formatting.
  * Suggest relevant actions like starting a free trial or checking out pricing or contact sections.
SYS;

        if (!empty($apiKey)) {
            try {
                $messages = [
                    ['role' => 'system', 'content' => $systemPrompt],
                ];

                foreach (array_slice($history, -6) as $msg) {
                    if (isset($msg['role'], $msg['content']) && in_array($msg['role'], ['user', 'assistant'])) {
                        $messages[] = [
                            'role' => $msg['role'],
                            'content' => $msg['content'],
                        ];
                    }
                }

                $messages[] = ['role' => 'user', 'content' => $userMessage];

                $response = Http::timeout(config('ai.timeout', 15))
                    ->withToken($apiKey)
                    ->post("{$endpoint}/chat/completions", [
                        'model' => $model,
                        'messages' => $messages,
                        'temperature' => 0.4,
                        'max_tokens' => 350,
                    ]);

                if ($response->successful()) {
                    $reply = trim($response->json('choices.0.message.content', ''));
                    if (!empty($reply)) {
                        return [
                            'reply' => $reply,
                            'source' => 'TaskVerge AI (' . $model . ')',
                        ];
                    }
                } else {
                    Log::warning("Landing AI chat HTTP error [{$response->status()}]: " . $response->body());
                }
            } catch (\Throwable $e) {
                Log::warning('Landing AI chat error: ' . $e->getMessage());
            }
        }

        return $this->heuristicLandingReply($userMessage);
    }

    /**
     * Fallback heuristic responses for landing page visitors when LLM is offline or unkeyed.
     */
    protected function heuristicLandingReply(string $userMessage): array
    {
        $msg = strtolower(trim($userMessage));

        if (preg_match('/^(hi|hello|hey|greetings|good\s*(morning|afternoon|evening))\b/i', $msg)) {
            $reply = "### Welcome to TaskVerge\n\nI am the TaskVerge AI Assistant. How can I assist you today?\n\n- Inquire about our **workflow automation & capabilities**\n- Compare **pricing plans & 14-day free trial**\n- Access our **global office addresses & contact info**\n- Discover how **Cortex AI** eliminates operational drag";
        } elseif (preg_match('/(price|pricing|cost|plan|subscription|tier|core|enterprise|how much)/i', $msg)) {
            $reply = "### TaskVerge Pricing & Plans\n\nTaskVerge provides three transparent tiers designed to scale with your organization:\n\n- **Free Trial (14 Days):** 1 active pipeline, 3 team members, and up to 50 tasks with no credit card required.\n- **Operations Core ($49/month):** 5 operational pipelines, 15 team seats, proactive SLA radar alerts, and automated triage.\n- **Enterprise Intelligence ($199/month):** Unlimited pipelines, unlimited seats, dedicated Cortex Copilot, custom webhooks, and SOC2 audit logging.\n\nReview details and choose your tier in our [Pricing Section](#pricing).";
        } elseif (preg_match('/(contact|support|email|phone|call|address|office|branch|location|where|sri lanka|usa)/i', $msg)) {
            $reply = "### Corporate Offices & Global Support\n\n- **Head Office (Sri Lanka):** Taskverge PVT LTD\n  165/7 Pickerings Road, Colombo 01500, Sri Lanka | Phone: **+94717285555**\n- **USA Branch Office:** Taskverge LLC\n  255 Ferry Blvd, Stratford, CT 06615, United States | Phone: **+12038708505**\n- **Universal Support Inbox:** [help@taskverge.net](mailto:help@taskverge.net)\n\nYou can also submit an inquiry using our [Contact Form](#contact).";
        } elseif (preg_match('/(what is|feature|capability|how it works|cortex|copilot|automate|what can you do|capabilities)/i', $msg)) {
            $reply = "### What Makes TaskVerge Different?\n\nTaskVerge is an **Autonomous Workflow Intelligence platform** that stops tasks from stalling between teams:\n\n1. **Autonomous Stage Transitions:** Tasks advance automatically as milestones and criteria are fulfilled.\n2. **Proactive SLA Radar:** Predicts bottlenecks up to 48 hours before deadlines are missed.\n3. **Workload Balance Guard:** Automatically alerts and redistributes unbalanced team queues.\n4. **Cortex Copilot™:** Live natural language assistance to draft, triage, and unblock work items in seconds.\n\nReady to see it in action? You can [Create an Account](/register) or test our interactive demo!";
        } elseif (preg_match('/(trial|demo|sign up|register|start|test|free)/i', $msg)) {
            $reply = "### Get Started with TaskVerge\n\nYou can start immediately with our **14-day Free Trial**:\n\n- No credit card required\n- Instant access to intuitive Kanban workspaces\n- Built-in AI triage and team collaboration\n\n[Click here to sign up](/register) or explore our [Capabilities](#what-it-does).";
        } elseif (preg_match('/(security|privacy|compliance|data|gdpr|safe)/i', $msg)) {
            $reply = "### Enterprise Security & Privacy\n\nYour operational data is safeguarded with enterprise-grade protection:\n\n- Encrypted at rest (AES-256) and in transit (TLS 1.3)\n- Comprehensive immutable Audit Logs for compliance\n- Full compliance with our [Privacy Policy](/privacy) and [Terms of Service](/terms).\n\nFeel free to ask any specific compliance questions!";
        } else {
            $reply = "### Welcome to TaskVerge\n\nI am your **TaskVerge AI Assistant**. How can I help you today?\n\n- Ask about our **features & workflow automation**\n- Inquire about **pricing & free trials**\n- Ask for our **offices & contact details**\n- Learn how **Cortex AI** eliminates operational bottlenecks\n\nWhat would you like to explore?";
        }

        return [
            'reply' => $reply,
            'source' => 'TaskVerge Knowledge Engine',
        ];
    }
}


