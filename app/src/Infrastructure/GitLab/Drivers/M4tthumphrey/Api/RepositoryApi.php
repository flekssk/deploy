<?php

namespace App\Infrastructure\GitLab\Drivers\M4tthumphrey\Api;

use App\Infrastructure\GitLab\Api\RepositoryApiInterface;
use App\Infrastructure\GitLab\Dto\RepositoryDto;
use Gitlab\Api\Repositories;

class RepositoryApi implements RepositoryApiInterface
{
    /**
     * @var Repositories
     */
    private $repositoriesApi;

    public function __construct(Repositories $repositoriesApi)
    {
        $this->repositoriesApi = $repositoriesApi;
    }

    public function getBranches(RepositoryDto $repository)
    {
        return $this->repositoriesApi->branches($repository->getName());
    }

    public function getBranch(RepositoryDto $repository, string $name)
    {
        return $this->repositoriesApi->branch($repository->getName(), $name);
    }

    public function createBranch(RepositoryDto $repository, string $name, string $ref)
    {
        return $this->repositoriesApi->createBranch($repository->getName(), $name, $ref);
    }
}
