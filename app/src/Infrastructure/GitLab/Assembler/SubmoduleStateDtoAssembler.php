<?php

namespace App\Infrastructure\GitLab\Assembler;

use App\Infrastructure\GitLab\Dto\SubmoduleStateDto;

class SubmoduleStateDtoAssembler implements SubmoduleStateDtoAssemblerInterface
{
    public function assemble(string $submoduleName, string $commitSha): SubmoduleStateDto
    {
        $dto = new SubmoduleStateDto($submoduleName, $commitSha);

        return $dto;
    }
}
