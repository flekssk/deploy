<?php

namespace App\Application\Deploy;

use App\Domain\Entity\Project\Project;
use App\Infrastructure\Pipeline\CommandBuilder;
use App\Infrastructure\Pipeline\DeployService;

use App\Infrastructure\Pipeline\GitApi\Commands\MergeCommand;
use App\Infrastructure\Pipeline\GitApi\Commands\MergeCommandInterface;
use App\Infrastructure\Pipeline\Pipeline;
use App\Infrastructure\GitLab\Assembler\MergeDtoAssemblerInterface;
use App\Infrastructure\GitLab\Assembler\RepositoryDtoAssemblerInterface;

class DeployProdService
{
    private $deployService;

    private $mergeDtoAssembler;

    private $repositoryDtoAssembler;
    /**
     * @var CommandBuilder
     */
    private $commandBuilder;

    public function __construct(
        DeployService $deployService,
        CommandBuilder $commandBuilder,
        RepositoryDtoAssemblerInterface $repositoryDtoAssembler,
        MergeDtoAssemblerInterface $mergeDtoAssembler
    )
    {
        $this->deployService = $deployService;
        $this->commandBuilder = $commandBuilder;
        $this->mergeDtoAssembler = $mergeDtoAssembler;
        $this->repositoryDtoAssembler = $repositoryDtoAssembler;
    }

    /**
     * @param Project $project
     * @param string  $releaseName
     * @param string  $targetBranch
     *
     * @throws \App\Infrastructure\Pipeline\Exceptions\CommandFailedException
     */
    public function deploy(Project $project, string $releaseName, string $targetBranch)
    {
        $releaseBranch = 'release/' . $releaseName;

        $repositoryDto = $this->repositoryDtoAssembler->assemble($project);
        $mergeDto = $this->mergeDtoAssembler->assemble($repositoryDto, $targetBranch, $releaseBranch);

        $mergeCommand = $this->commandBuilder->build(MergeCommandInterface::class);
        $mergeCommand->setMergeDto($mergeDto);

        $pipeline = new Pipeline();

        $pipeline->addCommand($mergeCommand);

        $this->deployService->deploy($pipeline);
    }
}
