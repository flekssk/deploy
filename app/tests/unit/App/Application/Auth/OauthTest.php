<?php

namespace App\Tests\unit\App\Application\Auth;

use App\Application\Auth\Oauth;
use App\Domain\Entity\User;
use Codeception\Test\Unit;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request;

class OauthTest extends Unit
{
    /**
     * @var Oauth $oauth
     */
    private $oauth;
    private $em;

    public function _before()
    {
        /** @var Doctrine\ORM\EntityManager */
        $this->em = $this->getModule('Doctrine2')->em;
        $client = new Client();

        $this->oauth = new Oauth($this->em, $client);
    }

    public function testCheckCredentialsTrue()
    {
        $mock = new \stdClass();
        $mock->id = '1';

        $status = $this->oauth->checkCredentials($mock, new User());
        $this->assertTrue($status);
    }

    public function testCheckCredentialsFalse()
    {
        $result = $this->oauth->checkCredentials(null, new User());
        $this->assertFalse($result);
    }

    public function testRememberMeNeedToBeDisabled()
    {
        $result = $this->oauth->supportsRememberMe();
        $this->assertFalse($result);
    }

    public function testNotAvailableIfWeNotAtAuthPage()
    {
        $request = new Request();
        $status = $this->oauth->supports($request);

        $this->assertFalse($status);
    }

    public function testAvailableOnlyIfWeAtTheAuthPage()
    {
        $request = new Request([], [], [], [], [], ['REQUEST_URI' => '/oauth']);
        $status = $this->oauth->supports($request);

        $this->assertTrue($status);
    }
}