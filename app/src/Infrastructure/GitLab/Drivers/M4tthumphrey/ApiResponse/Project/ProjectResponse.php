<?php

namespace App\Infrastructure\GitLab\Drivers\M4tthumphrey\ApiResponse\Project;

use App\Infrastructure\GitLab\ApiResponse\ProjectResponseInterface;

class ProjectResponse implements ProjectResponseInterface
{
    private $id;
    private $name;
    private $path;
    private $pathWithNamespace;

    public function __construct(array $apiResponse)
    {
        $this->id = $apiResponse['id'];
        $this->name = $apiResponse['name'];
        $this->path = $apiResponse['path'];
        $this->pathWithNamespace = $apiResponse['path_with_namespace'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getPathWithNamespace(): string
    {
        return $this->pathWithNamespace;
    }
}
