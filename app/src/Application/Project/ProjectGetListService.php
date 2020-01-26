<?php

namespace App\Application\Project;

use App\Application\Project\Assembler\ProjectListDtoAssemblerInterface;
use App\Domain\Repository\Project\ProjectRepositoryInterface;
use App\Infrastructure\Pipeline\CommandBuilder;
use App\Infrastructure\Pipeline\GitApi\Commands\CreateBranchCommand;
use App\Infrastructure\Pipeline\GitApi\Commands\CreateBranchCommandInterface;

class ProjectGetListService
{
    /**
     * @var ProjectListDtoAssemblerInterface
     */
    private $projectListDtoAssembler;
    /**
     * @var ProjectRepositoryInterface
     */
    private $projectRepository;

    public function __construct(
        ProjectListDtoAssemblerInterface $projectListDtoAssembler,
        ProjectRepositoryInterface $projectRepository,
        CommandBuilder $commandBuilder
    )
    {
        $commandBuilder->build(CreateBranchCommand::class);

        $this->projectListDtoAssembler = $projectListDtoAssembler;
        $this->projectRepository = $projectRepository;
    }

    public function get(): array
    {
        $list = $this->projectRepository->all();

        return $this->projectListDtoAssembler->assemble($list);
    }
}
