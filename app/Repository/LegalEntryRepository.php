<?php

namespace App\Repository;

use App\Enums\IncomingEnum;
use App\Models\LegalEntry;

class LegalEntryRepository implements LegalEntryRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function create(array $data): LegalEntry
    {
        $legalEntry = new LegalEntry();

        return $this->update($data, $legalEntry);
    }

    /**
     * @inheritdoc
     */
    public function update(array $data, LegalEntry $entry): LegalEntry
    {
        $entry->name = $data['name'] ?? null;
        $entry->edrpou_code = $data['edrpou_code'] ?? null;
        $entry->legal_address = $data['legal_address'] ?? null;
        $entry->actual_address = $data['actual_address'] ?? null;
        $entry->contact_person = $data['contact_person'] ?? null;
        $entry->phone = $data['phone'] ?? null;
        $entry->activity = $data['activity'] ?? null;
        $entry->landline_phone = $data['landline_phone'] ?? null;
        $entry->net_profit_type = $data['net_profit_type'] ?? IncomingEnum::INCOMING_FIRST_TYPE;
        $entry->carrying_amount = $data['carrying_amount'] ?? null;
        $entry->carrying_date = $data['carrying_date'] ?? null;
        $entry->carrying_type = $data['carrying_type'] ?? IncomingEnum::INCOMING_FIRST_TYPE;
        $entry->payables = $data['payables'] ?? null;
        $entry->payables_date = $data['payables_date'] ?? null;
        $entry->payables_type = $data['payables_type'] ?? IncomingEnum::INCOMING_FIRST_TYPE;
        $entry->receivables = $data['receivables'] ?? null;
        $entry->receivables_date = $data['receivables_date'] ?? null;
        $entry->receivables_type = $data['receivables_type'] ??IncomingEnum::INCOMING_FIRST_TYPE;

        $entry->save();

        return $entry;
    }
}
