<?php

namespace Asjad\LaravelAI\Drivers;

use Illuminate\Support\Facades\Http;
use Asjad\LaravelAI\Contracts\AIProvider;

class OpenAIProvider implements AIProvider
{
    public function chat(array $messages): string
    {
        $response = Http::withToken(config('ai.api_key'))
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => config('ai.model', 'gpt-4o-mini'),
                'messages' => $messages,
            ]);

        if ($response->failed()) {
            return $response->body();
        }

        return data_get($response->json(), 'choices.0.message.content', '');
    }
}