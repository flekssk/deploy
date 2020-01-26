<?php

namespace App\Infrastructure\GitLab\Drivers\M4tthumphrey\ApiResponse\Deployment;

use App\Infrastructure\GitLab\ApiResponse\DeploymentResponseInterface;
use App\Infrastructure\GitLab\ApiResponse\DeploymentsResponseInterface;

class DeploymentsResponse implements DeploymentsResponseInterface
{
    /**
     * @var DeploymentResponseInterface[]
     */
    private $deployments;

    public function __construct(array $deployments)
    {
        $this->deployments = $deployments;
    }

    public function all(): array
    {
        return $this->deployments;
    }
}
