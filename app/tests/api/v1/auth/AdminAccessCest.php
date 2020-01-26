<?php

declare(strict_types=1);

namespace App\Tests\api\v1\auth;

use App\Tests\ApiTester;

class AdminAccessCest
{
    private $url = '/admin';

    public function requestWithoutAuthShouldRedirectToLoginPage(ApiTester $I): void
    {
        $I->sendGET($this->url);
        $I->amOnPage('/login');
    }
}
