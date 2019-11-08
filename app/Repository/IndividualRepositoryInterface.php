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

    /**
     * @param array $data
     * @param Individual $individual
     * @return Individual
     */
    public function update(array $data, Individual $individual): Individual;
}
