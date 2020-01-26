<?php

namespace App\Infrastructure\Pipeline;

interface CommandInterface
{
    public function run(): bool;
}
