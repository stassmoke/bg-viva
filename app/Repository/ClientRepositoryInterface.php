<?php

namespace App\Repository;

use App\DTO\FilterDTO;
use App\DTO\SortByDTO;
use App\Models\Client;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ClientRepositoryInterface
{
    /**
     * @param int $id
     * @return Client|null|object
     */
    public function find(int $id): ?Client;

    /**
     * @param User $user
     * @param FilterDTO $filterDTO
     * @param SortByDTO $sortByDTO
     * @return LengthAwarePaginator|\Illuminate\Pagination\LengthAwarePaginator
     */
    public function findByUserAndPaginate(User $user, FilterDTO $filterDTO, SortByDTO $sortByDTO): LengthAwarePaginator;

    /**
     * @param array $data
     * @return Client
     */
    public function create(array $data): Client;

    /**
     * @param array $data
     * @param Client $client
     * @return Client
     */
    public function update(array $data, Client $client): Client;
}
