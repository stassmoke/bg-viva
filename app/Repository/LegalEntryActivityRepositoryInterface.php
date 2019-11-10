<?php

namespace App\Repository;

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
}
