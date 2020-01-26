<?php

namespace App\Tests\integrational\App\Application\Auth;

use App\Application\Auth\Oauth;
use App\Infrastructure\Persistence\Doctrine\Repository\User\UserProvider;
use Codeception\TestCase\Test;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use function GuzzleHttp\Psr7\stream_for;
use Symfony\Component\HttpFoundation\Request;

class OauthTest extends Test
{
    /**
     * @var Oauth $oauth
     */
    private $oauth;
    private $em;

    private $newUser = [
        'id' => '2',
        'name' => 'New Test User',
        'email' => 'newtestuser@test.net',
    ];

    private $dataAuthUserByCode = '{"access_token": "ad82525d003e1c4c0011527e0001294b000000caebbf8487625953e603922edf0dc2a1"}';
    private $dataGetUserInfo = '{"id":"76107","active":true,"email":"ushakov@action-media.ru","name":"\u0423\u0448\u0430\u043a\u043e\u0432 \u041f\u0430\u0432\u0435\u043b","last_name":"\u0423\u0448\u0430\u043a\u043e\u0432","second_name":"\u0418\u0432\u0430\u043d\u043e\u0432\u0438\u0447","personal_gender":"M","personal_profession":null,"personal_www":null,"personal_birthday":"1990-02-20T03:00:00+03:00","personal_photo":"https:\/\/home.action-mcfr.ru\/upload\/main\/20a\/IMG_7307.JPG","personal_icq":null,"personal_phone":null,"personal_fax":null,"personal_mobile":"+7 (900) 699-9682","personal_pager":null,"personal_street":null,"personal_city":null,"personal_state":null,"personal_zip":null,"personal_country":null,"work_company":null,"work_position":"\u0412\u0435\u0434\u0443\u0449\u0438\u0439 \u0440\u0430\u0437\u0440\u0430\u0431\u043e\u0442\u0447\u0438\u043a","work_phone":"","uf_department":[85545],"uf_interests":null,"uf_skills":null,"uf_web_sites":null,"uf_linkedin":null,"uf_facebook":null,"uf_twitter":null,"uf_skype":null,"uf_district":null,"uf_phone_inner":null,"full_name":"\u0423\u0448\u0430\u043a\u043e\u0432 \u041f\u0430\u0432\u0435\u043b","sub":"76107","given_name":"\u041f\u0430\u0432\u0435\u043b","family_name":"\u0418\u0432\u0430\u043d\u043e\u0432\u0438\u0447","picture":"https:\/\/home.action-mcfr.ru\/upload\/main\/20a\/IMG_7307.JPG"}';

    public function _before()
    {
        /** @var Doctrine\ORM\EntityManager */
        $this->em = $this->getModule('Doctrine2')->em;
        $client = $this->getGuzzleClient();

        $this->oauth = new Oauth($this->em, $client);
    }

    public function testUserCredential()
    {
        $request = new Request([
            'code' => 'a589515d003e1c4c0011527e0001294b000000bf446881e431293ec43799b90b442a83',
            'server_domain' => 'oauth.bitrix.info',
            'domain' => '‌home.action-mcfr.ru',
        ]);

        $user = $this->oauth->getCredentials($request);

        $this->assertSame($this->dataGetUserInfo, json_encode($user));
    }

    public function testGetUserIfHeAuthEarlier()
    {
        $credentials = new \stdClass();
        $credentials->id = '1';

        $user = $this->oauth->getUser($credentials, new UserProvider($this->em));
        $this->assertEquals($credentials->id, $user->getUuid());
    }

    public function testCreateUserIfDoesNotExist()
    {
        $user = $this->oauth->getUser((object)$this->newUser, new UserProvider($this->em));
        $this->assertEquals('2', $user->getUuid());
    }

    private function getGuzzleClient()
    {
        $bodyAuthUserByCode = stream_for($this->dataAuthUserByCode);
        $bodyGetUserInfo = stream_for($this->dataGetUserInfo);

        $mock = new MockHandler([
            new Response(200, [], $bodyAuthUserByCode),
            new Response(200, [], $bodyGetUserInfo),
        ]);

        $handler = HandlerStack::create($mock);

        return new Client(['handler' => $handler]);
    }
}