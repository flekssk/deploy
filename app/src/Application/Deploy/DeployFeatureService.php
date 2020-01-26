<?php

namespace App\Application\Deploy;

use App\Domain\Entity\Project\Project;
use App\Infrastructure\Pipeline\CommandBuilder;
use App\Infrastructure\Pipeline\DeployService;
use App\Infrastructure\Pipeline\GitApi\Commands\CreateBranchCommand;
use App\Infrastructure\Pipeline\GitApi\Commands\CreateBranchCommandInterface;
use App\Infrastructure\Pipeline\GitApi\Commands\PushSubmoduleCommand;
use App\Infrastructure\Pipeline\GitApi\Commands\PushSubmoduleCommandInterface;
use App\Infrastructure\Pipeline\Pipeline;
use App\Infrastructure\GitLab\Assembler\BranchDtoAssemblerInterface;
use App\Infrastructure\GitLab\Assembler\SubmoduleStateDtoAssemblerInterface;

class DeployFeatureService
{
    private $deployService;

    private $branchDtoAssembler;

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
        $this->branchDtoAssembler = $branchDtoAssembler;
        $this->submoduleStateDtoAssembler = $submoduleStateDtoAssembler;
        $this->commandBuilder = $commandBuilder;
    }

    /**
     * @param Project $project
     * @param string  $featureName
     *
     * @param string  $coreSha
     */
    public function deploy(Project $project, string $featureName, string $coreSha)
    {
        $featureBranchName = 'feature/' . $featureName;

        $branchDto = $this->branchDtoAssembler->assemble($project, $featureBranchName, 'master');
        $submoduleStateDto = $this->submoduleStateDtoAssembler->assemble('app/src/core', $coreSha);

        $createBranchCommand = $this->commandBuilder->build(CreateBranchCommandInterface::class);
        $createBranchCommand->setBranch($branchDto);

        $setCoreCommand = $this->commandBuilder->build(PushSubmoduleCommandInterface::class);
        $setCoreCommand->setBranch($branchDto);
        $setCoreCommand->setSubmoduleState($submoduleStateDto);

        $pipeline = new Pipeline();

        $pipeline->addCommand($createBranchCommand);
        $pipeline->addCommand($setCoreCommand);

        $this->deployService->deploy($pipeline);
    }
}
