<?php

namespace App\Infrastructure\GitLab\Assembler;

use App\Domain\Entity\Project\Project;
use App\Infrastructure\GitLab\Dto\RepositoryDto;

class RepositoryDtoAssembler implements RepositoryDtoAssemblerInterface
{
    public function assemble(Project $project): RepositoryDto
    {
        $dto = new RepositoryDto($project->getName());

        return $dto;
    }
}
