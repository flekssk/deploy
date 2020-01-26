<?php

namespace App\Tests\unit\App\Persistense\Doctrine\Repository\User;

use App\Domain\Entity\User;
use App\Infrastructure\Persistence\Doctrine\Repository\User\UserProvider;
use Codeception\Test\Unit;

class UserProviderTest extends Unit
{
    /**
     * @var UserProvider $up
     */
    private $up;

    protected function _before()
    {
        $em = $this->getModule('Doctrine2')->em;
        $this->up = new UserProvider($em);
    }

    public function testUserMustBeInstanceOfUser()
    {
        $user = new User();
        $user->setUuid('1');

        $result = $this->up->refreshUser($user);
        $this->assertEquals($user->getUuid(), $result->getUuid());
    }

    public function testSupportsOnlyUserClass()
    {
        $result = $this->up->supportsClass(User::class);
        $this->assertTrue($result);
    }
}