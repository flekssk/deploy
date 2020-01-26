<?php

namespace App\Infrastructure\GitLab;

use App\Infrastructure\GitLab\Api\DeploymentsApiInterface;
use App\Infrastructure\GitLab\Api\JobsApiInterface;
use App\Infrastructure\GitLab\Api\MergeRequestApiInterface;
use App\Infrastructure\GitLab\Api\ProjectApiInterface;
use App\Infrastructure\GitLab\Api\RepositoryApiInterface;
use App\Infrastructure\GitLab\Api\SubmoduleApiInterface;

interface GitApiInterface
{
    public function project(): ProjectApiInterface;

    public function repository(): RepositoryApiInterface;

    public function deployment(): DeploymentsApiInterface;

    public function mergeRequest(): MergeRequestApiInterface;

    public function submodules(): SubmoduleApiInterface;

    public function jobs(): JobsApiInterface;
}
