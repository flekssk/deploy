<?php


namespace App\Application\Project\Assembler;

use App\Application\Project\Dto\Display\ProjectDisplayDto;
use App\Domain\Entity\Project\Project;

interface ProjectDisplayDtoAssemblerInterface
{
    public function assemble(Project $project): ProjectDisplayDto;
}
