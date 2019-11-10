<?php

namespace App\Repository;

use App\Models\Individual;
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

        return $this->update($data, $movables);
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

    /**
     * @inheritdoc
     */
    public function removeWhereNotIdByIndividual(iterable $ids, Individual $individual): void
    {
        Movables::query()
            ->where('individual_id','=', $individual)
            ->whereNotIn('id', $ids)
            ->delete()
        ;
    }
}
