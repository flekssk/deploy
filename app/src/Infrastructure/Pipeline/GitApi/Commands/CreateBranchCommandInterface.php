<?php

namespace App\Infrastructure\Pipeline\GitApi\Commands;

use App\Infrastructure\GitLab\Dto\BranchDto;

interface CreateBranchCommandInterface
{
    public function getBranch(): BranchDto;
}
