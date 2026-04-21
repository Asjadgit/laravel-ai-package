<?php

return [
    'driver' => env('AI_DRIVER', 'openai'),

    'api_key' => env('AI_API_KEY'),

    'model' => env('AI_MODEL', 'gpt-4o-mini'),

    'timeout' => 30,
];