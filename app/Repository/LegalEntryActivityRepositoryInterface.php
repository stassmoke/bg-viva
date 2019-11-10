<?php

namespace App\Repository;

use App\Models\LegalEntry;
use App\Models\LegalEntryActivity;

interface LegalEntryActivityRepositoryInterface
{
    /**
     * @param array $data
     * @return LegalEntryActivity
     */
    public function create(array $data): LegalEntryActivity;

    /**
     * @param array $data
     * @param LegalEntryActivity $legalEntryActivity
     * @return LegalEntryActivity
     */
    public function update(array $data, LegalEntryActivity $legalEntryActivity): LegalEntryActivity;

    /**
     * @param iterable $ids
     * @param LegalEntry $legalEntry
     */
    public function removeWhereNotIdByLegalEntry(iterable $ids, LegalEntry $legalEntry): void;
}
