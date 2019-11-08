<?php

namespace App\Repository;

use App\Models\Movables;

class MovablesRepository implements MovablesRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function create(array $data): Movables
    {
        $movables = new Movables();

        $movables->individual_id = $data['individual_id'];

        $this->update($data, $movables);
    }

    /**
     * @inheritdoc
     */
    public function update(array $data, Movables $movables): Movables
    {
        $movables->description = $data['description'];

        $movables->save();

        return $movables;
    }
}
