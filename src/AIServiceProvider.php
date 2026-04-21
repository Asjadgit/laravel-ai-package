<?php

namespace Asjad\LaravelAI;

use Illuminate\Support\ServiceProvider;
use Asjad\LaravelAI\Services\AIManager;

class AIServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/ai.php', 'ai');

        $this->app->singleton('ai', function () {
            return new AIManager();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/ai.php' => config_path('ai.php'),
        ], 'ai-config');
    }
}