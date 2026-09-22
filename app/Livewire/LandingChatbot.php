<?php

namespace App\Livewire;

use App\Services\CortexAiService;
use Livewire\Component;

class LandingChatbot extends Component
{
    public bool $isOpen = false;
    public string $inputMessage = '';
    public array $messages = [];
    public bool $isTyping = false;
    public string $aiModel = '';
    public bool $hasApiKey = false;

    public function mount(): void
    {
        $this->aiModel = config('ai.model', 'llama-3.3-70b-versatile');
        $this->hasApiKey = !empty(config('ai.api_key'));

        $this->messages = [
            [
                'role' => 'assistant',
                'content' => "👋 Hi there! I'm the **TaskVerge AI Assistant** connected to the **Cortex™ Intelligence Engine**.\n\nI can help you explore our autonomous workflow engine, pricing, platform features, or corporate details. What would you like to know?",
                'time' => now()->format('H:i'),
            ],
        ];
    }

    public function toggleChat(): void
    {
        $this->isOpen = !$this->isOpen;
    }

    public function openChat(): void
    {
        $this->isOpen = true;
    }

    public function closeChat(): void
    {
        $this->isOpen = false;
    }

    public function sendPreset(string $preset): void
    {
        $this->inputMessage = $preset;
        $this->sendMessage();
    }

    public function sendMessage(): void
    {
        $text = trim($this->inputMessage);
        if (empty($text)) {
            return;
        }

        // Add user message
        $this->messages[] = [
            'role' => 'user',
            'content' => $text,
            'time' => now()->format('H:i'),
        ];

        $this->inputMessage = '';
        $this->isTyping = true;

        try {
            $aiService = app(CortexAiService::class);
            $result = $aiService->chatWithLandingVisitor($this->messages, $text);

            $this->messages[] = [
                'role' => 'assistant',
                'content' => $result['reply'] ?? "I'm sorry, I couldn't process that. Please contact help@taskverge.net for assistance.",
                'source' => $result['source'] ?? 'TaskVerge AI',
                'time' => now()->format('H:i'),
            ];
        } catch (\Throwable $e) {
            $this->messages[] = [
                'role' => 'assistant',
                'content' => "Thank you for reaching out! You can learn more about our platform capabilities or reach out directly to **help@taskverge.net** or call **+94717285555**.",
                'source' => 'TaskVerge Support',
                'time' => now()->format('H:i'),
            ];
        } finally {
            $this->isTyping = false;
        }
    }

    public function clearChat(): void
    {
        $this->mount();
    }

    public function render()
    {
        return view('livewire.landing-chatbot');
    }
}
