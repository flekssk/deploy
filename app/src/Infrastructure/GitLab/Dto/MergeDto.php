<?php

namespace App\Infrastructure\GitLab\Dto;

class MergeDto
{
    /**
     * @var string
     */
    private $targetBranch;

    /**
     * @var string
     */
    private $branchName;
    /**
     * @var RepositoryDto
     */
    private $repositoryDto;

    public function __construct(RepositoryDto $repositoryDto, string $targetBranch, string $branchName)
    {
        $this->targetBranch = $targetBranch;
        $this->branchName = $branchName;
        $this->repositoryDto = $repositoryDto;
    }

    /**
     * @return string
     */
    public function getTargetBranch(): string
    {
        return $this->targetBranch;
    }

    /**
     * @return string
     */
    public function getBranchName(): string
    {
        return $this->branchName;
    }

    /**
     * @return RepositoryDto
     */
    public function getRepositoryDto(): RepositoryDto
    {
        return $this->repositoryDto;
    }
}
