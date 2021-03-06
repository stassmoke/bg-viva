<?php

namespace App\Repository;

use App\Models\Equipment;
use App\Models\LegalEntry;

interface EquipmentRepositoryInterface
{
    /**
     * @param array $data
     * @return Equipment
     */
    public function create(array $data): Equipment;

    /**
     * @param array $data
     * @param Equipment $equipment
     * @return Equipment
     */
    public function update(array $data, Equipment $equipment): Equipment;

    /**
     * @param iterable $ids
     * @param LegalEntry $legalEntry
     */
    public function removeWhereNotIdByLegalEntry(iterable $ids, LegalEntry $legalEntry): void;
}
