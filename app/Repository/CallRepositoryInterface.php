<?php

namespace App\Repository;

use App\Models\Call;

interface CallRepositoryInterface
{
    /**
     * @param int $id
     * @return Call|null
     */
    public function find(int $id): ?Call;
}
