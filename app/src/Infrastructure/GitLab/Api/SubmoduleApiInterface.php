<?php

namespace App\Infrastructure\GitLab\Api;

use App\Infrastructure\GitLab\Dto\BranchDto;
use App\Infrastructure\GitLab\Dto\SubmoduleStateDto;

interface SubmoduleApiInterface
{
    public function pushSubmoduleState(
        BranchDto $branchDto,
        SubmoduleStateDto $submoduleStateDto,
        string $commitMessage
    );
}
