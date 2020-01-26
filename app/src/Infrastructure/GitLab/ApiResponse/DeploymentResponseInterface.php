<?php

namespace App\Infrastructure\GitLab\ApiResponse;

interface DeploymentResponseInterface
{
    public function getId(): int;

    public function getIid(): int;

    public function getRef(): int;

    public function getSha(): string;

    public function getStatus(): string;

    public function getEnvironments(): array;
}
