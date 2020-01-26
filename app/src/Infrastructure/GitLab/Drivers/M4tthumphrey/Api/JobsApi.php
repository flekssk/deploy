<?php

namespace App\Infrastructure\GitLab\Drivers\M4tthumphrey\Api;

use App\Domain\Entity\Project\Project;
use App\Infrastructure\GitLab\Api\JobsApiInterface;
use App\Infrastructure\GitLab\Dto\JobDto;
use Gitlab\Api\Jobs;

class JobsApi implements JobsApiInterface
{
    /**
     * @var Jobs
     */
    private $jobsApi;

    public function __construct(Jobs $jobsApi)
    {
        $this->jobsApi = $jobsApi;
    }

    public function runJob(Project $project, JobDto $jobDto)
    {
        return $this->jobsApi->play($project->getName(), $jobDto->getId());
    }
}
