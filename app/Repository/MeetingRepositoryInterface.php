<?php

namespace App\Repository;

use App\DTO\FilterDTO;
use App\DTO\SortByDTO;
use App\Models\Meeting;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface MeetingRepositoryInterface
{
    /**
     * @param int $id
     * @return Meeting|null
     */
    public function find(int $id): ?Meeting;

    /**
     * @param User $user
     * @param FilterDTO $filterDTO
     * @param SortByDTO $sortByDTO
     * @return LengthAwarePaginator|\Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByUserAndPaginate(User $user, FilterDTO $filterDTO, SortByDTO $sortByDTO): LengthAwarePaginator;

    /**
     * @param array $data
     * @return Meeting
     */
    public function create(array $data): Meeting;

    /**
     * @param array $data
     * @param Meeting $meeting
     * @return Meeting
     */
    public function update(array $data, Meeting $meeting): Meeting;
}
