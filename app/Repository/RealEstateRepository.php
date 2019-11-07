<?php

namespace App\Repository;

use App\Models\RealEstate;

class RealEstateRepository implements RealEstateRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function create(array $data): RealEstate
    {
        $realEstate = new RealEstate();

        $realEstate->description = $data['description'];
        $realEstate->individual_id = $data['individual_id'];

        $realEstate->save();

        return $realEstate;
    }
}
