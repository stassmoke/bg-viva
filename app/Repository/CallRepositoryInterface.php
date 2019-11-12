<?php

namespace App\Repository;

use App\DTO\FilterDTO;
use App\DTO\SortByDTO;
use App\Models\Call;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CallRepositoryInterface
{
    /**
     * @param int $id
     * @return Call|null
     */
    public function find(int $id): ?Call;

    /**
     * @param User $user
     * @param FilterDTO $filterDTO
     * @param SortByDTO $sortByDTO
     * @return LengthAwarePaginator|\Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByUserAndPaginate(User $user, FilterDTO $filterDTO, SortByDTO $sortByDTO): LengthAwarePaginator;

    /**
     * @param array $data
     * @return Call
     */
    public function create(array $data): Call;

    /**
     * @param array $data
     * @param Call $call
     * @return Call
     */
    public function update(array $data, Call $call): Call;
}
