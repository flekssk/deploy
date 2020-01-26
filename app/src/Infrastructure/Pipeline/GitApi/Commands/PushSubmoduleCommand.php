<?php

namespace App\Infrastructure\Pipeline\GitApi\Commands;

use App\Infrastructure\Pipeline\CommandInterface;
use App\Infrastructure\Pipeline\GitApi\GitCommandInterface;
use App\Infrastructure\GitLab\Dto\BranchDto;
use App\Infrastructure\GitLab\Dto\RepositoryDto;
use App\Infrastructure\GitLab\Dto\SubmoduleStateDto;

class PushSubmoduleCommand implements PushSubmoduleCommandInterface, GitCommandInterface, CommandInterface
{
    /**
     * @var SubmoduleStateDto
     */
    private $submoduleState;

    /**
     * @var BranchDto
     */
    private $branch;

    /**
     * @return SubmoduleStateDto
     */
    public function getSubmoduleState(): SubmoduleStateDto
    {
        return $this->submoduleState;
    }

    /**
     * @return BranchDto
     */
    public function getBranch(): BranchDto
    {
        return $this->branch;
    }

    /**
     * @param SubmoduleStateDto $submoduleState
     */
    public function setSubmoduleState(SubmoduleStateDto $submoduleState): void
    {
        $this->submoduleState = $submoduleState;
    }

    /**
     * @param BranchDto $branch
     */
    public function setBranch(BranchDto $branch): void
    {
        $this->branch = $branch;
    }

    public function run(): bool
    {
        // TODO: Implement run() method.
    }
}
