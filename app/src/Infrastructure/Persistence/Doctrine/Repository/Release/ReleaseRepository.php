<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository\Release;

use App\Domain\Entity\Release\Release;
use App\Domain\Entity\ValueObject\Id;
use App\Domain\Repository\NotFoundException;
use App\Domain\Repository\Release\ReleaseRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Ramsey\Uuid\Uuid;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ReleaseRepository extends ServiceEntityRepository implements ReleaseRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Release::class);
    }

    /**
     * @return Release[]
     */
    public function all(): array
    {
        return $this->findAll();
    }

    /**
     * @inheritdoc
     */
    public function getNextIdentity(): Id
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        $uuid = Uuid::uuid4();

        return new Id($uuid->toString());
    }

    public function get(int $id): Release
    {
        $release = $this->find($id);

        if(is_null($release)) {
            throw new NotFoundException(sprintf('Release with ID %s not found', $id));
        }

        return $release;
    }

    public function getByName(string $name): Release
    {
        $release = $this->findOneBy(['name' => $name]);

        if(is_null($release)) {
            throw new NotFoundException(sprintf('Release with NAME %s not found', $name));
        }

        return $release;
    }

    public function save(Release $release)
    {
        try {
            $this->getEntityManager()->persist($release);
            $this->getEntityManager()->flush();
        } catch (OptimisticLockException|ORMException $e) {
            throw new \RuntimeException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param string $name
     *
     * @return Release
     */
    public function getByNameOrCreate(string $name): Release
    {
        if(!$this->isExist($name)) {
            $release = new Release($this->getNextIdentity(), $name);
        }

        return $this->getByName($name);
    }

    public function isExist(string $name)
    {
        return $this->count(['name' => $name]) > 0;
    }
}
