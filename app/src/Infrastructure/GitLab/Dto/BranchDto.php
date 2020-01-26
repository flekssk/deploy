<?php

namespace App\Infrastructure\GitLab\Dto;

class BranchDto
{
    private $repository;

    private $name;

    private $refBranch;

    public function __construct(RepositoryDto $repository, string $name, string $refBranch)
    {
        $this->repository = $repository;
        $this->name = $name;
        $this->refBranch = $refBranch;
    }

    /**
     * @return RepositoryDto
     */
    public function getRepository(): RepositoryDto
    {
        return $this->repository;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getRefBranch(): string
    {
        return $this->refBranch;
    }
}
