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
        $estate = new RealEstate();

        $estate->individual_id = $data['individual_id'];

        return $this->update($data, $estate);
    }

    /**
     * @inheritdoc
     */
    public function update(array $data, RealEstate $estate): RealEstate
    {
        $estate->description = $data['description'];

        $estate->save();

        return $estate;
    }
}
