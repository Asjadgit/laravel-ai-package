<?php

namespace Asjad\LaravelAI\Contracts;

interface AIProvider
{
    public function chat(array $messages): string;
}