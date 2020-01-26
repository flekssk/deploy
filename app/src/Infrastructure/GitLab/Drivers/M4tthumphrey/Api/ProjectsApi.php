<?php

namespace App\Infrastructure\GitLab\Drivers\M4tthumphrey\Api;

use App\Infrastructure\GitLab\Api\ProjectApiInterface;
use App\Infrastructure\GitLab\ApiResponse\ProjectResponseInterface;
use App\Infrastructure\GitLab\Drivers\M4tthumphrey\ApiResponse\Project\ProjectResponse;
use App\Infrastructure\GitLab\Dto\RepositoryDto;
use Gitlab\Api\Projects;

class ProjectsApi implements ProjectApiInterface
{
    /**
     * @var Projects
     */
    private $projectsApi;

    public function __construct(Projects $projectsApi)
    {
        $this->projectsApi = $projectsApi;
    }

    public function get(RepositoryDto $repositoryDto): ProjectResponseInterface
    {
        $responseDate = $this->projectsApi->show($repositoryDto->getName());

        $response = new ProjectResponse($responseDate);

        return $response;
    }
}
