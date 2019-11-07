<?php

namespace App\Repository;

use App\Models\Movables;

interface MovablesRepositoryInterface
{
    /**
     * @param array $data
     * @return Movables
     */
    public function create(array $data): Movables;
}
