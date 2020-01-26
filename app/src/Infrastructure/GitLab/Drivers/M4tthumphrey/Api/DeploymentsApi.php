<?php

namespace App\Infrastructure\GitLab\Drivers\M4tthumphrey\Api;

use App\Domain\Entity\Project\Project;
use App\Infrastructure\GitLab\Api\DeploymentsApiInterface;
use App\Infrastructure\GitLab\ApiResponse\DeploymentResponseInterface;
use App\Infrastructure\GitLab\ApiResponse\DeploymentsResponseInterface;
use App\Infrastructure\GitLab\Drivers\M4tthumphrey\ApiResponse\Deployment\DeploymentResponse;
use App\Infrastructure\GitLab\Drivers\M4tthumphrey\ApiResponse\Deployment\DeploymentsResponse;
use App\Infrastructure\GitLab\Dto\DeploymentDto;
use Gitlab\Api\Deployments;

class DeploymentsApi implements DeploymentsApiInterface
{
    /**
     * @var Deployments
     */
    private $deploymentApi;

    public function __construct(Deployments $deploymentApi)
    {
        $this->deploymentApi = $deploymentApi;
    }

    public function getDeployment(DeploymentDto $deploymentDto): DeploymentResponseInterface
    {
        $deployment = $this->deploymentApi->show($deploymentDto->getProject()->getName(), $deploymentDto->getId());
        $response = $this->createDeploymentResponse($deployment);

        return $response;
    }

    public function getDeployments(Project $project): DeploymentsResponseInterface
    {
        $deployments = $this->deploymentApi->all($project->getName());
        $response = $this->createDeploymentsResponse($deployments);

        return $response;
    }

    public function createDeploymentsResponse(array $deployments)
    {
        $deploymentsArray = [];

        foreach ($deployments as $deployment) {
            $deploymentsArray[] = $this->createDeploymentResponse($deployment);
        }

        $deploymentsResponse = new DeploymentsResponse($deploymentsArray);

        return $deploymentsResponse;
    }

    public function createDeploymentResponse(array $deployment)
    {
        $deploymentResponse = new DeploymentResponse();

        $deploymentResponse->setId($deployment['id']);
        $deploymentResponse->setIid($deployment['iid']);
        $deploymentResponse->setSha($deployment['sha']);
        $deploymentResponse->setRef($deployment['ref']);
        $deploymentResponse->setStatus($deployment['status']);
        $deploymentResponse->setEnvironments($deployment['environment']);

        return $deploymentResponse;
    }
}
