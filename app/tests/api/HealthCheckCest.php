<?php

namespace App\Tests\api;

use App\Tests\ApiTester;

class HealthCheckCest
{
    public function requestShouldReturnStatusInfo(ApiTester $I): void
    {
        $I->sendGET('/');

        $I->seeResponseCodeIs(200);

        $I->canSeeResponseJsonMatchesJsonPath('$.project');
        $I->canSeeResponseJsonMatchesJsonPath('$.service');
    }
}
