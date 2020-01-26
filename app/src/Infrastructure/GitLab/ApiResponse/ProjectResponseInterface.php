<?php

namespace App\Infrastructure\GitLab\ApiResponse;

interface ProjectResponseInterface
{
    public function getId(): int;

    public function getName(): string;

    public function getPath(): string;

    public function getPathWithNamespace(): string;
}
