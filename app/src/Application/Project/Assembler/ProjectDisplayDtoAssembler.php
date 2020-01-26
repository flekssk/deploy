<?php

namespace App\Application\Project\Assembler;

use App\Application\Project\Dto\Display\ProjectDisplayDto;
use App\Domain\Entity\Project\Project;

class ProjectDisplayDtoAssembler implements ProjectDisplayDtoAssemblerInterface
{
    public function assemble(Project $project): ProjectDisplayDto
    {
        $dto = new ProjectDisplayDto((int)$project->getId(), $project->getName());

        return $dto;
    }
}
