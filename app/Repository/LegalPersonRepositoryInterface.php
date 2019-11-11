<?php

namespace App\Repository;

use App\Models\LegalEntry;
use App\Models\LegalPerson;

interface LegalPersonRepositoryInterface
{
    /**
     * @param array $data
     * @return LegalPerson
     */
    public function create(array $data): LegalPerson;

    /**
     * @param array $data
     * @param LegalPerson $legalPerson
     * @return LegalPerson
     */
    public function update(array $data, LegalPerson $legalPerson): LegalPerson;

    /**
     * @param iterable $ids
     * @param LegalEntry $legalEntry
     */
    public function removeWhereNotIdByLegalEntry(iterable $ids, LegalEntry $legalEntry): void;
}
