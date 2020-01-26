<?php

namespace App\Infrastructure\GitLab\Assembler;

use App\Domain\Entity\Project\Project;
use App\Infrastructure\GitLab\Dto\BranchDto;

class BranchDtoAssembler implements BranchDtoAssemblerInterface
{
    /**
     * @var RepositoryDtoAssemblerInterface
     */
    private $repositoryDtoAssembler;

    public function __construct(RepositoryDtoAssemblerInterface $repositoryDtoAssembler)
    {
        $this->repositoryDtoAssembler = $repositoryDtoAssembler;
    }

    public function assemble(Project $project, $branchName, string $branchRef): BranchDto
    {
        $repository = $this->repositoryDtoAssembler->assemble($project);

        $dto = new BranchDto(
            $repository,
            $branchName,
            $branchRef
        );

        return $dto;
    }
}
