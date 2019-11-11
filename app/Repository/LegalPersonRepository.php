<?php

namespace App\Repository;

use App\Models\LegalEntry;
use App\Models\LegalPerson;

class LegalPersonRepository implements LegalPersonRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function create(array $data): LegalPerson
    {
        $legalPerson = new LegalPerson();

        $legalPerson->legal_entity_id = $data['legal_entity_id'];

        return $this->update($data, $legalPerson);
    }

    /**
     * @inheritdoc
     */
    public function update(array $data, LegalPerson $legalPerson): LegalPerson
    {
        $legalPerson->description = $data['description'];

        $legalPerson->save();

        return $legalPerson;
    }

    /**
     * @inheritdoc
     */
    public function removeWhereNotIdByLegalEntry(iterable $ids, LegalEntry $legalEntry): void
    {
        LegalPerson::query()
            ->where('legal_entity_id','=', $legalEntry->id)
            ->whereNotIn('id', $ids)
            ->delete()
        ;
    }
}
