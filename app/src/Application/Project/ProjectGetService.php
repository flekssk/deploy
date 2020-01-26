<?php

namespace App\Application\Project;

use App\Application\Project\Assembler\ProjectDisplayDtoAssemblerInterface;
use App\Application\Project\Dto\Display\ProjectDisplayDto;
use App\Domain\Repository\Project\ProjectRepositoryInterface;

class ProjectGetService
{
    /**
     * @var ProjectRepositoryInterface
     */
    private $projectRepository;
    /**
     * @var ProjectDisplayDtoAssemblerInterface
     */
    private $projectDisplayDtoAssembler;

    public function __construct(
        ProjectRepositoryInterface $projectRepository,
        ProjectDisplayDtoAssemblerInterface $projectDisplayDtoAssembler
    )
    {
        $this->projectRepository = $projectRepository;
        $this->projectDisplayDtoAssembler = $projectDisplayDtoAssembler;
    }

    /**
     * @param int $id
     *
     * @return Dto\Display\ProjectDisplayDto
     */
    public function get(int $id): ProjectDisplayDto
    {
        $project = $this->projectRepository->get($id);

        return $this->projectDisplayDtoAssembler->assemble($project);
    }
}
