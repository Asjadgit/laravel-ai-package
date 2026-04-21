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
}