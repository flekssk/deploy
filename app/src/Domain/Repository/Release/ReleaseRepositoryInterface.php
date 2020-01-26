<?php

namespace App\Domain\Repository\Release;

use App\Domain\Entity\Release\Release;
use App\Domain\Entity\ValueObject\Id;

interface ReleaseRepositoryInterface
{
    public function getNextIdentity(): Id;

    /**
     * @return Release[]
     */
    public function all(): array;

    public function save(Release $release);

    public function get(int $id): Release;

    public function getByName(string $name): Release;

    public function getByNameOrCreate(string $name): Release;

    public function isExist(string $name);
}
