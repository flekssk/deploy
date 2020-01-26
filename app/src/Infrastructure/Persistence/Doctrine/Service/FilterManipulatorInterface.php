<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Service;

interface FilterManipulatorInterface
{
    /**
     * @param callable $func
     * @param string[] $filters Массив строк фильтров для включения/отключения,
     * пример: ['-softDeletable', 'isActive'] - выключит фильтр softDeletable и включт фильтр isActive
     * @return mixed result of call given func
     */
    public function runWithFilters(callable $func, $filters = []);

}
