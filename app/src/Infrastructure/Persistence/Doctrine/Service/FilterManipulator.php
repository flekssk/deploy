<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Service;

use Doctrine\ORM\EntityManagerInterface;

class FilterManipulator implements FilterManipulatorInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * SoftDeletableFilterService constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @inheritDoc
     */
    public function runWithFilters(callable $func, $filters = [])
    {
        $filtersConfigAr = array_map(function (string $filterStr) {
            return $this->parse($filterStr);
        }, $filters);

        $existentFilters = $this->em->getFilters();
        $changedToEnabledFilters = [];
        $changedToDisabledFilters = [];

        foreach ($filtersConfigAr as $item) {
            [$filterName, $isEnabled] = $item;

            $isAlreadyEnabled = $existentFilters->isEnabled($filterName);

            if ($isEnabled === true && $isAlreadyEnabled === false) {
                $existentFilters->enable($filterName);
                $changedToEnabledFilters[] = $filterName;
                continue;
            }

            if ($isEnabled === false && $isAlreadyEnabled === true) {
                $existentFilters->disable($filterName);
                $changedToDisabledFilters[] = $filterName;
                continue;
            }
        }

        $result = $func();

        foreach ($changedToEnabledFilters as $filterName) {
            $existentFilters->disable($filterName);
        }

        foreach ($changedToDisabledFilters as $filterName) {
            $existentFilters->enable($filterName);
        }

        return $result;
    }

    /**
     * @param $filterStr
     * @return array
     */
    private function parse($filterStr): array
    {
        $isEnabled = true;
        $filterName = $filterStr;

        if (strpos($filterName, '-') === 0) {
            $filterName = substr($filterName, 1);
            $isEnabled = false;
        } elseif (strpos($filterName, '+') === 0) {
            $filterName = substr($filterName, 1);
        }

        return [$filterName, $isEnabled];
    }

}
