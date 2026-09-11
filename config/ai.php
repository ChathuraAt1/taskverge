<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cortex AI LLM Configuration
    |--------------------------------------------------------------------------
    |
    | Standard OpenAI-compatible API configuration supporting Groq, NVIDIA NIM,
    | OpenAI, vLLM, and Ollama.
    |
    */
    'endpoint' => env('AI_API_ENDPOINT', 'https://api.groq.com/openai/v1'),
    'api_key' => env('AI_API_KEY', ''),
    'model' => env('AI_MODEL', 'llama-3.3-70b-versatile'),
    'timeout' => (int) env('AI_TIMEOUT', 15),
];
