<?php

namespace App\Infrastructure\GitLab\Assembler;

use App\Domain\Entity\Project\Project;
use App\Infrastructure\GitLab\Dto\RepositoryDto;

interface RepositoryDtoAssemblerInterface
{
    public function assemble(Project $project): RepositoryDto;
}
