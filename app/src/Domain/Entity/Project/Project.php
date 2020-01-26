<?php

namespace App\Domain\Entity\Project;

use App\Domain\Entity\ValueObject\Id;
use App\Domain\Repository\Project\BranchRepositoryInterface;

class Project
{
    /**
     * @var Id
     */
    private $id;
    /**
     * @var string
     */
    private $name;

    public function __construct(Id $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }
}
