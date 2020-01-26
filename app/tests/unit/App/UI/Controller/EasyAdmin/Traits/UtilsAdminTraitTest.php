<?php

namespace App\Tests\unit\App\UI\Controller\EasyAdmin\Traits;

use Codeception\Test\Unit;

use App\Domain\Entity\News\Site;
use App\Domain\Entity\User;
use App\UI\Controller\EasyAdmin\Traits\UtilsAdminTrait;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class UtilsAdminTraitTest extends Unit
{
    use UtilsAdminTrait;

    private $mockUserEntity = '{"id":1,"title":"New site","domain":"www.site.new","appId":123:[]}';

    protected function _before()
    {
        $this->serializer = $this->getSerializer();
        $this->savePreviousEntityState();
    }

    public function testSavePreviousEntityState()
    {
        $this->assertIsObject($this->oldEntity);
    }

    public function testGetFalseIfEntitiesTheSame()
    {
        $user = clone $this->oldEntity;

        $result = $this->getOldEntity($user);

        $this->assertFalse($result);
    }

    public function testGetClassNameFromNamespace()
    {
        $result = $this->getClassNameFromNamespace(User::class);
        $this->assertEquals('User', $result);
    }

    public function testUnserializeSiteEntity()
    {
        $result = $this->unserializeEntity($this->mockUserEntity, Site::class);

        $this->assertIsObject($result);
    }

    public function testSerializeSiteEntity()
    {
        $site = new Site();
        $site->setId(1);
        $site->setTitle('New site');
        $site->setDomain('www.site.new');
        $site->setAppId('123');

        $result = $this->serializeEntity($site);

        $this->assertEquals($this->mockUserEntity, $result);
    }

    public function testStripeDataBeforeDepthWhenWeNormalizeData()
    {
        $mockData = [
            'id' => '76107',
            'uuid' => '76107',
            'name' => 'Ушаков Павел',
            'email' => 'ushakov@action-media.ru',
            'active' => true,
            'createdAt' => '2019-08-12T16:26:16+03:00',
            'role' => 'Администратор',
            'roleRealName' => 'ROLE_ADMIN',
            'username' => 'Ушаков Павел',
            'roles' => ['ROLE_ADMIN'],
            'deletedAt' => NULL,
            'password' => NULL,
            'salt' => NULL,
        ];
        $mockForCheckResult = [
            'id' => '76107',
            'uuid' => '76107',
            'name' => 'Ушаков Павел',
            'email' => 'ushakov@action-media.ru',
            'active' => true,
            'createdAt' => '2019-08-12T16:26:16+03:00',
            'role' => 'Администратор',
            'roleRealName' => 'ROLE_ADMIN',
            'publishGroup' => [
                [
                    'id' => 5,
                    'name' => 'Изменение',
                ],
            ],
            'username' => 'Ушаков Павел',
            'roles' => 'ROLE_ADMIN',
            'deletedAt' => NULL,
            'password' => NULL,
            'salt' => NULL,
        ];

        $result = $this->normalizeData($mockData);

        $this->assertEquals($mockForCheckResult, $result);
    }

    private function getEasyAdminAttribute(): array
    {
        $user = new User();
        $user->setUuid('1');
        $user->setName('Old user data');

        return ['item' => $user];
    }

    private function getSerializer()
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        return new Serializer($normalizers, $encoders);
    }
}
