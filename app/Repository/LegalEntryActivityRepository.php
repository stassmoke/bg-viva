<?php

namespace App\Repository;

use App\Models\LegalEntry;
use App\Models\LegalEntryActivity;

class LegalEntryActivityRepository implements LegalEntryActivityRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function create(array $data): LegalEntryActivity
    {
        $legalEntryActivity = new LegalEntryActivity();

        $legalEntryActivity->legal_entity_id = $data['legal_entity_id'];

        return $this->update($data, $legalEntryActivity);
    }

    /**
     * @inheritdoc
     */
    public function update(array $data, LegalEntryActivity $legalEntryActivity): LegalEntryActivity
    {
        $legalEntryActivity->description = $data['description'];

        $legalEntryActivity->save();

        return $legalEntryActivity;
    }

    /**
     * @inheritdoc
     */
    public function removeWhereNotIdByLegalEntry(iterable $ids, LegalEntry $legalEntry): void
    {
        LegalEntryActivity::query()
            ->where('legal_entity_id','=', $legalEntry->id)
            ->whereNotIn('id', $ids)
            ->delete()
        ;
    }
}
