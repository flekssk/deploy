<?php

namespace App\Infrastructure\GitLab\Assembler;

use App\Infrastructure\GitLab\Dto\JobDto;

class JobDtoAssembler implements JobDtoAssemblerInterface
{

    public function assemble(int $id): JobDto
    {
        $dto = new JobDto($id);

        return $dto;
    }
}
