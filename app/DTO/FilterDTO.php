<?php

namespace App\DTO;

class FilterDTO
{
    /**
     * @var int
     */
    private $page;

    /**
     * @var int
     */
    private $perPage;

    /**
     * @var string
     */
    private $term;

    /**
     * @var array
     */
    private $filters;

    /**
     * FilterDTO constructor.
     * @param int $page
     * @param int $perPage
     * @param array $filters
     */
    public function __construct(int $page, int $perPage, array $filters = [])
    {
        $this->page = $page;
        $this->perPage = $perPage;
        $this->filters = $filters;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * @param int $perPage
     */
    public function setPerPage(int $perPage): void
    {
        $this->perPage = $perPage;
    }

    /**
     * @return string|null
     */
    public function getTerm(): ?string
    {
        return $this->term;
    }

    /**
     * @param string|null $term
     */
    public function setTerm(?string $term): void
    {
        $this->term = filter_var($term);
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return $this->filters;
    }

    /**
     * @param array $filters
     */
    public function setFilters(array $filters): void
    {
        $this->filters = $filters;
    }
}
