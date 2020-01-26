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

class DeployRCService
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
        $this->commandBuilder = $commandBuilder;
        $this->branchDtoAssembler = $branchDtoAssembler;
        $this->submoduleStateDtoAssembler = $submoduleStateDtoAssembler;
    }

    /**
     * @param Project $project
     * @param string  $releaseName
     * @param string  $coreSha
     */
    public function deploy(Project $project, string $releaseName, string $coreSha)
    {
        $releaseBranchName = 'release/' . $releaseName;

        $releaseBranchDto = $this->branchDtoAssembler->assemble($project, $releaseBranchName, 'master');
        $submoduleStateDto = $this->submoduleStateDtoAssembler->assemble('app/src/core', $coreSha);

        $createBranchCommand = $this->commandBuilder->build(CreateBranchCommandInterface::class);
        $createBranchCommand->setBranch($releaseBranchDto);

        $setCoreCommand = $this->commandBuilder->build(PushSubmoduleCommandInterface::class);
        $setCoreCommand->setBranch($releaseBranchDto);
        $setCoreCommand->setSubmoduleState($submoduleStateDto);

        $pipeline = new Pipeline();

        $pipeline->addCommand($createBranchCommand);
        $pipeline->addCommand($setCoreCommand);

        $this->deployService->deploy($pipeline);
    }
}
