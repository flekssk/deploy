<?php

declare(strict_types=1);

namespace App\Tests\unit\App\Domain\Entity\ValueObject;

use App\Domain\Entity\ValueObject\Pagination;
use Codeception\Test\Unit;

class PaginationTest extends Unit
{

    /**
     * @param $page
     * @param $perPage
     * @param $count
     * @dataProvider correctValueDataProvider
     */
    public function testCorrectValueShouldNotRaiseException($page, $perPage, $count): void
    {
        new Pagination($page, $perPage, $count);
    }

    public function correctValueDataProvider(): array
    {
        return [
            [1, 1, 1],
            [2, 1, 3],
            [3, 10, 23],
            [1, 1, 0],
        ];
    }

    /**
     * @param $currentPage
     * @param $perPage
     * @param $totalCount
     * @dataProvider incorrectValueDataProvider
     */
    public function testIncorrectValueShouldRaiseException($currentPage, $perPage, $totalCount): void
    {
        $this->expectException(\DomainException::class);

        new Pagination($currentPage, $perPage, $totalCount);
    }

    public function incorrectValueDataProvider(): array
    {
        return [
            'zero current page' => [0, 1, 1],
            'zero per page' => [1, 0, 1],
            'negative total count' => [1, 1, -1],
            'current page more than total pages count' => [4, 10, 23],
        ];
    }
}
