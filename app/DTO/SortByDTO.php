<?php

namespace App\DTO;

class SortByDTO
{
    /**
     * @var string
     */
    private $orderBy;

    /**
     * @var string
     */
    private $direction;

    /**
     * SortByDTO constructor.
     * @param string $orderBy
     * @param string $direction
     */
    public function __construct(string $orderBy, string $direction)
    {
        $this->orderBy = $orderBy;
        $this->direction = $direction;
    }

    /**
     * @return string
     */
    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }
}
