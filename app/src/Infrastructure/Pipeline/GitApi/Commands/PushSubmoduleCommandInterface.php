<?php

namespace App\Infrastructure\Pipeline\GitApi\Commands;

use App\Infrastructure\GitLab\Dto\BranchDto;
use App\Infrastructure\GitLab\Dto\SubmoduleStateDto;

interface PushSubmoduleCommandInterface
{
    public function getSubmoduleState(): SubmoduleStateDto;

    public function getBranch(): BranchDto;
}
