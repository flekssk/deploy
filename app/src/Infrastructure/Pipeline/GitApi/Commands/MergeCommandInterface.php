<?php

namespace App\Infrastructure\Pipeline\GitApi\Commands;

use App\Infrastructure\GitLab\Dto\MergeDto;

interface MergeCommandInterface
{
    public function getMergeDto(): MergeDto;
}
