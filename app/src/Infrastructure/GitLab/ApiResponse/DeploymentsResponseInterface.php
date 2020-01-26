<?php

namespace App\Infrastructure\GitLab\ApiResponse;

interface DeploymentsResponseInterface
{
    public function all(): array;
}
