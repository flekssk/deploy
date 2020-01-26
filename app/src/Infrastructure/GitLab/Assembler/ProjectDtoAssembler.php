<?php

namespace App\Infrastructure\GitLab\Assembler;

use App\Infrastructure\GitLab\Dto\ProjectDto;

class ProjectDtoAssembler implements ProjectDtoAssemblerInterface
{
    public function assemble(string $name)
    {
        $dto = new ProjectDto($name);

        return $dto;
    }
}
