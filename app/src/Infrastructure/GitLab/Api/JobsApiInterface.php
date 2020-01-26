<?php

namespace App\Infrastructure\GitLab\Api;

use App\Domain\Entity\Project\Project;
use App\Infrastructure\GitLab\Dto\JobDto;

interface JobsApiInterface
{
    public function runJob(Project $project, JobDto $jobDto);
}
