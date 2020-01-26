<?php

namespace App\Domain\Entity\Release;

use App\Domain\Entity\ValueObject\Id;

class Release
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var Id
     */
    private $id;
    /**
     * @var \DateTime
     */
    private $createDate;

    public function __construct(Id $id, string $name, \DateTime $createDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->createDate = $createDate;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return \DateTime
     */
    public function getCreateDate(): \DateTime
    {
        return $this->createDate;
    }
}
