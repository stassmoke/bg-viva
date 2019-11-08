<?php

namespace App\Repository;

use App\Models\LegalEntry;

interface LegalEntryRepositoryInterface
{
    /**
     * @param array $data
     * @return LegalEntry
     */
    public function create(array $data): LegalEntry;

    /**
     * @param array $data
     * @param LegalEntry $entry
     * @return LegalEntry
     */
    public function update(array $data, LegalEntry $entry): LegalEntry;
}
