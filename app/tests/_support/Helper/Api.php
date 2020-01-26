<?php

namespace App\Tests\Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use App\Domain\Entity\ValueObject\Email;
use App\Domain\Repository\Client\ClientRepositoryInterface;
use App\Infrastructure\AuthToken\AuthTokenGeneratorInterface;
use Codeception\Module\Doctrine2;
use PHPUnit\Framework\Assert;

class Api extends \Codeception\Module
{
    /**
     * @param string $email
     * @return mixed
     */
    public function amAuthenticatedByEmail(string $email)
    {
        return $this->getModule('REST')->amBearerAuthenticated($this->createJwtTokenForUserByEmail($email));
    }

    /**
     * @param string $email
     * @return string
     * @throws \Codeception\Exception\ModuleException
     */
    public function createJwtTokenForUserByEmail(string $email): string
    {
        $module = $this->getModule('Symfony');
        $container = $module->kernel->getContainer();

        /** @var AuthTokenGeneratorInterface $generator */
        $generator = $container->get(AuthTokenGeneratorInterface::class);

        /** @var ClientRepositoryInterface $clientRepository */
        $clientRepository = $container->get(ClientRepositoryInterface::class);

        $token = $generator->generateToken($clientRepository->getByEmail(new Email($email)));

        return (string)$token;
    }

    public function grabRecord(string $table, array $values = []): ?array
    {
        /** @var Doctrine2 $module */
        $module = $this->getModule('Doctrine2');
        $conn = $module->_getEntityManager()->getConnection();

        $qb = $conn->createQueryBuilder();
        $qb->select()
            ->from($table);

        foreach ($values as $key => $value) {
            $qb->andWhere("$key = :$key")
                ->setParameter($key, $value);
        }

        $result = $qb->execute()->fetchAll();

        if (!$result) {
            return null;
        }

        return $result[0];
    }

    //See data into DB.
    public function seeRecord(string $table, array $values = []): void
    {
        if ($this->grabRecord($table, $values) === null) {
            Assert::fail("Could not find $table with " . json_encode($values));
        }

        $this->assertTrue(true);
    }
}
