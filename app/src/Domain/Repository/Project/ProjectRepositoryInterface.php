<?php

namespace App\Domain\Repository\Project;

use App\Domain\Entity\Project\Project;

interface ProjectRepositoryInterface
{
    /**
     * @return Project[]
     */
    public function all(): array;

    public function get(int $id): Project;

    public function getByName(string $name): Project;
}
