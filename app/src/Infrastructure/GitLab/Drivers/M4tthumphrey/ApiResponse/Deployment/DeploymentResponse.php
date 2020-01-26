<?php

namespace App\Infrastructure\GitLab\Drivers\M4tthumphrey\ApiResponse\Deployment;

use App\Infrastructure\GitLab\ApiResponse\DeploymentResponseInterface;

class DeploymentResponse implements DeploymentResponseInterface
{
    private $id;
    private $iid;
    private $ref;
    private $sha;
    private $status;
    private $environments;

    public function getId(): int
    {
        return $this->id;
    }

    public function getIid(): int
    {
        return $this->iid;
    }

    public function getRef(): int
    {
        return $this->ref;
    }

    public function getSha(): string
    {
        return $this->sha;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param mixed $iid
     */
    public function setIid($iid): void
    {
        $this->iid = $iid;
    }

    /**
     * @param mixed $ref
     */
    public function setRef($ref): void
    {
        $this->ref = $ref;
    }

    /**
     * @param mixed $sha
     */
    public function setSha($sha): void
    {
        $this->sha = $sha;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function getEnvironments(): array
    {
        return $this->environments;
    }

    /**
     * @param mixed $environments
     */
    public function setEnvironments($environments): void
    {
        $this->environments = $environments;
    }
}
