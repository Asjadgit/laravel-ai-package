<?php

namespace Asjad\LaravelAI\Services;

use Illuminate\Support\Facades\Http;

class AIManager
{
    public function chat(array $messages)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('ai.api_key'),
            'Content-Type' => 'application/json',
        ])
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => config('ai.model', 'gpt-4o-mini'),
                'messages' => $messages,
            ]);

        // 🔍 DEBUG if error
        if ($response->failed()) {
            dd([
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        }

        $json = $response->json();

        return data_get($json, 'choices.0.message.content', 'NO_RESPONSE');
    }
}
