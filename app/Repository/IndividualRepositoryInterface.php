<?php

namespace App\Repository;

use App\Models\Individual;

interface IndividualRepositoryInterface
{
    /**
     * @param array $data
     * @return Individual
     */
    public function create(array $data): Individual;
}
