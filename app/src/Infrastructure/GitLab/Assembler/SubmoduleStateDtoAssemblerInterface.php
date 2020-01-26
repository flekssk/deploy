<?php

namespace App\Infrastructure\GitLab\Assembler;

use App\Infrastructure\GitLab\Dto\SubmoduleStateDto;

interface SubmoduleStateDtoAssemblerInterface
{
    public function assemble(string $submoduleName,string $commitSha): SubmoduleStateDto;
}
