<?php

namespace Asjad\LaravelAI\Services;

use Illuminate\Support\Facades\Http;

class AIManager
{
    public function chat(array $messages)
    {
        $response = Http::withToken(config('ai.api_key'))
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => config('ai.model'),
                'messages' => $messages,
            ]);

        return $response['choices'][0]['message']['content'] ?? '';
    }
}