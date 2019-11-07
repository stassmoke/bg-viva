<?php

namespace App\Repository;

use App\Models\RealEstate;

interface RealEstateRepositoryInterface
{
    /**
     * @param array $data
     * @return RealEstate
     */
    public function create(array $data): RealEstate;
}
