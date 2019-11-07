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

        $movables->description = $data['description'];
        $movables->individual_id = $data['individual_id'];

        $movables->save();

        return $movables;
    }
}
