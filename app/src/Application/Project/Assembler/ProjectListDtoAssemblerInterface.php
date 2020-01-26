<?php

namespace App\Application\Project\Assembler;

interface ProjectListDtoAssemblerInterface
{
    public function assemble(array $list): array;
}
