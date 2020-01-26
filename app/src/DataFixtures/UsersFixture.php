<?php

declare(strict_types=1);

namespace App\DataFixtures;

class UsersFixture extends AbstractFixture
{
    public $tableName = 'users';
    public $dataFile = 'tests/fixtures/users.php';
}
