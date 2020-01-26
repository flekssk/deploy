<?php

namespace App\Infrastructure\Pipeline\GitApi\Commands;

use App\Infrastructure\Pipeline\CommandInterface;
use App\Infrastructure\Pipeline\GitApi\GitCommandInterface;
use App\Infrastructure\GitLab\Dto\MergeDto;

class MergeCommand implements MergeCommandInterface, GitCommandInterface, CommandInterface
{
    private $mergeDto;

    public function getMergeDto(): MergeDto
    {
        return $this->mergeDto;
    }

    /**
     * @param mixed $mergeDto
     */
    public function setMergeDto($mergeDto): void
    {
        $this->mergeDto = $mergeDto;
    }

    public function run(): bool
    {
        // TODO: Implement run() method.
    }
}
