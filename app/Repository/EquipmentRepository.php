<?php

namespace App\Repository;

use App\Models\Equipment;

class EquipmentRepository implements EquipmentRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function create(array $data): Equipment
    {
        $equipment = new Equipment();

        $equipment->legal_entity_id = $data['legal_entity_id'];

        return $this->update($data, $equipment);
    }

    /**
     * @inheritdoc
     */
    public function update(array $data, Equipment $equipment): Equipment
    {
        $equipment->description = $data['description'];

        $equipment->save();

        return $equipment;
    }
}
