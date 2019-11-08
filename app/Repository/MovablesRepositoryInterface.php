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

    /**
     * @param array $data
     * @param Movables $movables
     * @return Movables
     */
    public function update(array $data, Movables $movables): Movables;
}
