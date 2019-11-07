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
}
