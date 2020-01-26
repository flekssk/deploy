<?php

namespace App\Infrastructure\GitLab\Assembler;

use App\Infrastructure\GitLab\Dto\JobDto;

interface JobDtoAssemblerInterface
{
    public function assemble(int $id): JobDto;
}
