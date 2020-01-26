<?php

return [
    [
        'uuid' => '1',
        'roles' => 'ROLE_GUEST',
        'name' => 'Test User',
        'email' => 'test@test.net',
        'is_active' => true,
        'created_at' => (new DateTimeImmutable())->format('Y-m-d H:i:s'),
    ]
];
