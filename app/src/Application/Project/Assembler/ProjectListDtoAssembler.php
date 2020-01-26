<?php

namespace App\Application\Project\Assembler;

use App\Domain\Entity\Project\Project;

class ProjectListDtoAssembler implements ProjectListDtoAssemblerInterface
{
    /**
     * @var ProjectDisplayDtoAssembler
     */
    private $projectDisplayDtoAssembler;

    public function __construct(ProjectDisplayDtoAssembler $projectDisplayDtoAssembler)
    {
        $this->projectDisplayDtoAssembler = $projectDisplayDtoAssembler;
    }

    public function assemble(array $list): array
    {
        $list = array_map(
            function (Project $project) {
                return $this->projectDisplayDtoAssembler->assemble($project);
            }, $list
        );

        return $list;
    }
}
