<?php

namespace App\Repository;

use App\Models\LegalEntry;
use App\Models\LegalIndividualPerson;

interface LegalIndividualPersonRepositoryInterface
{
    /**
     * @param array $data
     * @return LegalIndividualPerson
     */
    public function create(array $data): LegalIndividualPerson;

    /**
     * @param array $data
     * @param LegalIndividualPerson $legalIndividualPerson
     * @return LegalIndividualPerson
     */
    public function update(array $data, LegalIndividualPerson $legalIndividualPerson): LegalIndividualPerson;

    /**
     * @param iterable $ids
     * @param LegalEntry $legalEntry
     */
    public function removeWhereNotIdByLegalEntry(iterable $ids, LegalEntry $legalEntry): void;
}
