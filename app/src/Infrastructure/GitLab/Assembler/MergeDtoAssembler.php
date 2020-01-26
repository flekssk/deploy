<?php

namespace App\Infrastructure\GitLab\Assembler;

use App\Infrastructure\GitLab\Dto\MergeDto;
use App\Infrastructure\GitLab\Dto\RepositoryDto;

class MergeDtoAssembler implements MergeDtoAssemblerInterface
{
    /**
     * @param RepositoryDto $repositoryDto
     * @param string        $targetBranchName
     * @param string        $branchName
     *
     * @return MergeDto
     */
    public function assemble(RepositoryDto $repositoryDto, string $targetBranchName, string $branchName): MergeDto
    {
        $dto = new MergeDto($repositoryDto, $targetBranchName, $branchName);

        return $dto;
    }
}
