<?php

namespace Asjad\LaravelAI\Drivers;

use Asjad\LaravelAI\Contracts\AIProvider;

class MockProvider implements AIProvider
{
    public function chat(array $messages): string
    {
        return 'Mock AI Response: ' . collect($messages)->last()['content'];
    }
}