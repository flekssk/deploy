<?php

namespace App\Infrastructure\GitLab\Dto;

use App\Domain\Entity\Project\Project;

class DeploymentDto
{
    /**
     * @var Project
     */
    private $project;
    /**
     * @var int
     */
    private $id;

    public function __construct(Project $project, int $id)
    {
        $this->id = $id;
        $this->project = $project;
    }

    /**
     * @return Project
     */
    public function getProject(): Project
    {
        return $this->project;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
