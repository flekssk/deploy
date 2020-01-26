<?php

namespace App\Infrastructure\GitLab\Dto;

class SubmoduleStateDto
{
    private $submoduleName;

    private $submoduleSha;

    /**
     * GitSubmoduleStateDro constructor.
     *
     * @param string $submoduleName
     * @param string $submoduleSha
     */
    public function __construct(string $submoduleName, string $submoduleSha)
    {
        $this->submoduleName = $submoduleName;
        $this->submoduleSha = $submoduleSha;
    }

    /**
     * @return string
     */
    public function getSubmoduleName(): string
    {
        return $this->submoduleName;
    }

    /**
     * @return string
     */
    public function getSubmoduleSha(): string
    {
        return $this->submoduleSha;
    }
}
