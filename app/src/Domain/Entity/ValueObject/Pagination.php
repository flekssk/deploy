<?php

declare(strict_types=1);

namespace App\Domain\Entity\ValueObject;

use Swagger\Annotations as SWG;

/**
 * Class Pagination
 * @package App\Domain\Entity\ValueObject
 *
 * @SWG\Definition(
 *     required={"page", "perPage", "count"},
 *     @SWG\Property(property="page", type="integer", example=1),
 *     @SWG\Property(property="perPage", type="integer", example=50),
 *     @SWG\Property(property="count", type="integer", example=10)
 * )
 *
 */
class Pagination implements \JsonSerializable
{
    /**
     * @var integer
     */
    private $currentPage;

    /**
     * @var integer
     */
    private $perPage;

    /**
     * @var integer
     */
    private $totalCount;

    /**
     * Pagination constructor.
     * @param int $currentPage
     * @param int $perPage
     * @param int $totalCount
     */
    public function __construct(int $currentPage, int $perPage, int $totalCount)
    {
        if ($currentPage < 1) {
            throw new \DomainException('Page number must be greater than zero');
        }
        if ($perPage < 1) {
            throw new \DomainException('The number of elements per page must be greater than zero');
        }
        if ($totalCount < 0) {
            throw new \DomainException('Total items count must be greater than or equal to zero');
        }

        $totalPagesCount = max(ceil($totalCount/$perPage), 1);

        if ($currentPage > $totalPagesCount) {
            throw new \DomainException(sprintf('Current page must be less or equal total pages count - "%s"', $totalPagesCount));
        }

        $this->currentPage = $currentPage;
        $this->perPage = $perPage;
        $this->totalCount = $totalCount;
    }

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * @return int
     */
    public function getTotalCount(): int
    {
        return $this->totalCount;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'currentPage' => $this->currentPage,
            'perPage' => $this->perPage,
            'totalCount' => $this->totalCount,
        ];
    }

    /**
     * @param Limit $limit
     * @param int $totalCount
     * @return self
     */
    public static function createFromLimitAndCount(Limit $limit, int $totalCount): self
    {
        $perPage = $limit->getLimit();
        $page = ($limit->getOffset() / $perPage) + 1;
        return new self($page, $perPage, $totalCount);
    }
}
