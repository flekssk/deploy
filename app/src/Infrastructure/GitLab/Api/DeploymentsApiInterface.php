<?php

namespace App\Infrastructure\GitLab\Api;

use App\Domain\Entity\Project\Project;
use App\Infrastructure\GitLab\ApiResponse\DeploymentResponseInterface;
use App\Infrastructure\GitLab\ApiResponse\DeploymentsResponseInterface;
use App\Infrastructure\GitLab\Dto\DeploymentDto;

interface DeploymentsApiInterface
{
    public function getDeployment(DeploymentDto $deploymentDto): DeploymentResponseInterface;

    public function getDeployments(Project $project): DeploymentsResponseInterface;
}
