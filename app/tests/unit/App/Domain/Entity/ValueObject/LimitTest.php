<?php

declare(strict_types=1);

namespace App\Tests\unit\App\Domain\Entity\ValueObject;

use App\Domain\Entity\ValueObject\Limit;
use Codeception\Test\Unit;

class LimitTest extends Unit
{
    /**
     * @param $offset
     * @param $limit
     * @dataProvider correctValueDataProvider
     */
    public function testCorrectValueShouldNotRaiseException($offset, $limit): void
    {
        new Limit($offset, $limit);
    }

    public function correctValueDataProvider(): array
    {
        return [
            [0, 1],
            [10, 100],
            [777, 2],
        ];
    }

    /**
     * @param $offset
     * @param $limit
     * @dataProvider incorrectValueDataProvider
     */
    public function testIncorrectValueShouldRaiseException($offset, $limit): void
    {
        $this->expectException(\DomainException::class);

        new Limit($offset, $limit);
    }

    public function incorrectValueDataProvider(): array
    {
        return [
            [-1, 10],
            [0, 0],
            [10, 0],
        ];
    }
}
