<?php

namespace App\Infrastructure\GitLab\Assembler;

interface ProjectDtoAssemblerInterface
{
    public function assemble(string $name);
}
