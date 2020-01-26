<?php

namespace App\Infrastructure\GitLab\Assembler;

use App\Infrastructure\GitLab\Dto\MergeDto;
use App\Infrastructure\GitLab\Dto\RepositoryDto;

interface MergeDtoAssemblerInterface
{
    public function assemble(RepositoryDto $repositoryDto, string $targetBranchName, string $branchName): MergeDto;
}
