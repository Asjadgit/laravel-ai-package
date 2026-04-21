<?php

namespace Asjad\LaravelAI\Services;

use Asjad\LaravelAI\Drivers\OpenAIProvider;
use Asjad\LaravelAI\Drivers\MockProvider;

class AIManager
{
    protected $driver;

    public function __construct()
    {
        $this->driver = $this->resolveDriver();
    }

    protected function resolveDriver()
    {
        return match (config('ai.driver', 'openai')) {
            'mock' => new MockProvider(),
            default => new OpenAIProvider(),
        };
    }

    public function chat(array $messages)
    {
        return $this->driver->chat($messages);
    }

    public function stream(array $messages, callable $callback)
    {
        $response = Http::withToken(config('ai.api_key'))
            ->withOptions([
                'stream' => true,
            ])
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => config('ai.model', 'gpt-4o-mini'),
                'messages' => $messages,
                'stream' => true,
            ]);

        $body = $response->getBody();

        while (!$body->eof()) {
            $chunk = $body->read(1024);

            if (!empty($chunk)) {
                $callback($chunk);
            }
        }
    }
}
