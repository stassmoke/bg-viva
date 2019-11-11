<?php

namespace App\Repository;

use App\Models\LegalEntry;
use App\Models\LegalIndividualPerson;

class LegalIndividualPersonRepository implements LegalIndividualPersonRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function create(array $data): LegalIndividualPerson
    {
        $legalIndividualPerson = new LegalIndividualPerson();

        $legalIndividualPerson->legal_entity_id = $data['legal_entity_id'];

        return $this->update($data, $legalIndividualPerson);
    }

    /**
     * @inheritdoc
     */
    public function update(array $data, LegalIndividualPerson $legalIndividualPerson): LegalIndividualPerson
    {
        $legalIndividualPerson->description = $data['description'];

        $legalIndividualPerson->save();

        return $legalIndividualPerson;
    }

    /**
     * @inheritdoc
     */
    public function removeWhereNotIdByLegalEntry(iterable $ids, LegalEntry $legalEntry): void
    {
        LegalIndividualPerson::query()
            ->where('legal_entity_id','=', $legalEntry->id)
            ->whereNotIn('id', $ids)
            ->delete()
        ;
    }
}
