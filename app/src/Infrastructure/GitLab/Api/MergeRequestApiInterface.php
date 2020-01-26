<?php

namespace App\Infrastructure\GitLab\Api;

use App\Infrastructure\GitLab\Dto\MergeDto;

interface MergeRequestApiInterface
{
    public function merge(MergeDto $mergeDto);

    public function applyMergeRequest();
}
