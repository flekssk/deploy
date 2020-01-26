<?php

namespace App\Infrastructure\GitLab\Api;

use App\Infrastructure\GitLab\ApiResponse\ProjectResponseInterface;
use App\Infrastructure\GitLab\Dto\RepositoryDto;

interface ProjectApiInterface
{
    public function get(RepositoryDto $repositoryDto): ProjectResponseInterface;
}
