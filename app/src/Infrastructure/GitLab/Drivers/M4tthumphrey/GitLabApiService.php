<?php

namespace App\Infrastructure\GitLab\Drivers\M4tthumphrey;

use App\Infrastructure\GitLab\Api\DeploymentsApiInterface;
use App\Infrastructure\GitLab\Api\JobsApiInterface;
use App\Infrastructure\GitLab\Api\MergeRequestApiInterface;
use App\Infrastructure\GitLab\Api\ProjectApiInterface;
use App\Infrastructure\GitLab\Api\RepositoryApiInterface;
use App\Infrastructure\GitLab\Api\SubmoduleApiInterface;
use App\Infrastructure\GitLab\Drivers\GitLab\M4tthumphrey\Api\SubmoduleApi;
use App\Infrastructure\GitLab\Drivers\M4tthumphrey\Api\DeploymentsApi;
use App\Infrastructure\GitLab\Drivers\M4tthumphrey\Api\JobsApi;
use App\Infrastructure\GitLab\Drivers\M4tthumphrey\Api\MergeRequestApi;
use App\Infrastructure\GitLab\Drivers\M4tthumphrey\Api\ProjectsApi;
use App\Infrastructure\GitLab\Drivers\M4tthumphrey\Api\RepositoryApi;
use App\Infrastructure\GitLab\GitApiInterface;
use Gitlab\Client;

/**
 * Class GitLabApiService
 *
 * @package App\Infrastructure\Git\Grivers\GitLab\M4tthumphrey
 */
class GitLabApiService implements GitApiInterface
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(string $apiUrl,string $apiToken)
    {
        $client = Client::create($apiUrl)
            ->authenticate($apiToken);

        $this->client = $client;
    }
    public function repository(): RepositoryApiInterface
    {
        return new RepositoryApi($this->client->repositories());
    }

    public function deployment(): DeploymentsApiInterface
    {
        return new DeploymentsApi($this->client->deployments());
    }

    public function mergeRequest(): MergeRequestApiInterface
    {
        return new MergeRequestApi($this->client->mergeRequests());
    }

    public function project(): ProjectApiInterface
    {
        return new ProjectsApi($this->client->projects());
    }

    public function submodules(): SubmoduleApiInterface
    {
        return new SubmoduleApi($this->client);
    }

    public function jobs(): JobsApiInterface
    {
        return new JobsApi($this->client->jobs());
    }
}
