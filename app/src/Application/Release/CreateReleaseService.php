<?php

namespace App\Application\Release;

use App\Domain\Entity\Project\Project;
use App\Domain\Entity\Release\Release;
use App\Infrastructure\Pipeline\CommandBuilder;
use App\Infrastructure\Pipeline\DeployService;
use App\Infrastructure\Pipeline\GitApi\Commands\CreateBranchCommand;
use App\Infrastructure\Pipeline\GitApi\Commands\CreateBranchCommandInterface;
use App\Infrastructure\Pipeline\GitApi\Commands\PushSubmoduleCommand;
use App\Infrastructure\Pipeline\GitApi\Commands\PushSubmoduleCommandInterface;
use App\Infrastructure\Pipeline\Pipeline;
use App\Infrastructure\GitLab\Assembler\BranchDtoAssemblerInterface;
use App\Infrastructure\GitLab\Assembler\SubmoduleStateDtoAssemblerInterface;

class CreateReleaseService
{
    /**
     * @var DeployService
     */
    private $deployService;
    /**
     * @var BranchDtoAssemblerInterface
     */
    private $branchDtoAssembler;
    /**
     * @var SubmoduleStateDtoAssemblerInterface
     */
    private $submoduleStateDtoAssembler;
    /**
     * @var CommandBuilder
     */
    private $commandBuilder;

    public function __construct(
        DeployService $deployService,
        CommandBuilder $commandBuilder,
        BranchDtoAssemblerInterface $branchDtoAssembler,
        SubmoduleStateDtoAssemblerInterface $submoduleStateDtoAssembler
    )
    {
        $this->deployService = $deployService;
        $this->commandBuilder = $commandBuilder;
        $this->branchDtoAssembler = $branchDtoAssembler;
        $this->submoduleStateDtoAssembler = $submoduleStateDtoAssembler;
    }

    /**
     * @param Project $project
     * @param Release $release
     * @param string  $coreName
     * @param string  $coreSha
     *
     * @return bool
     */
    public function deploy(Project $project, Release $release, string $coreName, string $coreSha): bool
    {
        $releaseBranchDto = $this->branchDtoAssembler->assemble($project, $release->getName(), 'master');
        $submoduleStateDto = $this->submoduleStateDtoAssembler->assemble($coreName, $coreSha);

        $createBranchCommand = $this->commandBuilder->build(CreateBranchCommandInterface::class);
        $createBranchCommand->setBranch($releaseBranchDto);

        $setCoreCommand = $this->commandBuilder->build(PushSubmoduleCommandInterface::class);
        $setCoreCommand->setBranch($releaseBranchDto);
        $setCoreCommand->setSubmoduleState($submoduleStateDto);

        $pipeline = new Pipeline();

        $pipeline->addCommand($createBranchCommand);
        $pipeline->addCommand($setCoreCommand);

        return $this->deployService->deploy($pipeline);
    }
}
