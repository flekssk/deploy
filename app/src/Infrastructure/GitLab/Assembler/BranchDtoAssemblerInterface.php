<?php

namespace App\Infrastructure\GitLab\Assembler;

use App\Domain\Entity\Project\Project;
use App\Infrastructure\GitLab\Dto\BranchDto;

interface BranchDtoAssemblerInterface
{
    public function assemble(Project $project,string $branchName, string $branchRef): BranchDto;
}
