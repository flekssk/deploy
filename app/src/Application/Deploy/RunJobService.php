<?php

namespace App\Application\Deploy;

use App\Domain\Entity\Project\Project;
use App\Infrastructure\GitLab\Assembler\JobDtoAssemblerInterface;
use App\Infrastructure\GitLab\Dto\JobDto;
use App\Infrastructure\GitLab\GitApiInterface;

class RunJobService
{
    /**
     * @var JobDtoAssemblerInterface
     */
    private $jobDtoAssembler;
    /**
     * @var GitApiInterface
     */
    private $gitApi;

    public function __construct(
        GitApiInterface $gitApi,
        JobDtoAssemblerInterface $jobDtoAssembler
    )
    {
        $this->gitApi = $gitApi;
        $this->jobDtoAssembler =  $jobDtoAssembler;
    }

    /**
     * @param Project $project
     * @param int     $jobId
     *
     * @return mixed
     */
    public function deploy(Project $project, int $jobId)
    {
        $jobDto = new JobDto($jobId);

        return $this->gitApi->jobs()->runJob($project, $jobDto);
    }
}
