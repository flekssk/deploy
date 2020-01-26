<?php

namespace App\Infrastructure\Pipeline\GitApi\Commands;

use App\Infrastructure\GitLab\GitApiInterface;
use App\Infrastructure\Pipeline\CommandInterface;
use App\Infrastructure\Pipeline\GitApi\GitCommandInterface;
use App\Infrastructure\GitLab\Dto\BranchDto;

class CreateBranchCommand implements CreateBranchCommandInterface, GitCommandInterface, CommandInterface
{
    private $branch;
    /**
     * @var GitApiInterface
     */
    private $api;

    public function __construct(GitApiInterface $api)
    {
        $this->api = $api;
    }

    public function getBranch(): BranchDto
    {
        return $this->branch;
    }

    /**
     * @param mixed $branch
     */
    public function setBranch($branch): void
    {
        $this->branch = $branch;
    }

    public function run(): bool
    {
    }
}
