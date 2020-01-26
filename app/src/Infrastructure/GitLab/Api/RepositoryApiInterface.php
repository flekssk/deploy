<?php

namespace App\Infrastructure\GitLab\Api;

use App\Infrastructure\GitLab\Dto\RepositoryDto;

interface RepositoryApiInterface
{
    public function getBranches(RepositoryDto $repository);

    public function getBranch(RepositoryDto $repository, string $name);

    public function createBranch(RepositoryDto $repository, string $name, string $ref);
}
