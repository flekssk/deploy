<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository\Project;

use App\Domain\Entity\Project\Project;
use App\Domain\Entity\ValueObject\Id;
use App\Domain\Repository\NotFoundException;
use App\Domain\Repository\Project\ProjectRepositoryInterface;
use App\Infrastructure\Persistence\Doctrine\Service\FilterManipulatorInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class ProjectRepository extends ServiceEntityRepository implements ProjectRepositoryInterface
{
    /**
     * @var FilterManipulatorInterface
     */
    private $filterManipulator;

    /**
     * ProjectRepository constructor.
     *
     * @param ManagerRegistry            $registry
     * @param FilterManipulatorInterface $filterManipulator
     */
    public function __construct(ManagerRegistry $registry, FilterManipulatorInterface $filterManipulator)
    {
        parent::__construct($registry, Project::class);

        $this->filterManipulator = $filterManipulator;
    }

    /**
     * @inheritDoc
     */
    public function get(int $id): Project
    {
        $project = $this->find($id);

        if ($project === null) {
            throw new NotFoundException(sprintf('Project with id %s not found', $id));
        }

        return $project;
    }

    /**
     * @inheritDoc
     */
    public function getByName(string $name): Project
    {
        $project = $this->findOneBy(['name' => $name]);

        if ($project === null) {
            throw new NotFoundException(sprintf('Project with name %s not found', $name));
        }

        return $project;
    }

    /**
     * @return Project[]
     */
    public function all(): array
    {
        return $this->findAll();
    }
}
