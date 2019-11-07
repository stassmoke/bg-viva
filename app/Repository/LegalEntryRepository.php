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

        $legalEntry->name = $data['name'] ?? null;
        $legalEntry->edrpou_code = $data['edrpou_code'] ?? null;
        $legalEntry->legal_address = $data['legal_address'] ?? null;
        $legalEntry->actual_address = $data['actual_address'] ?? null;
        $legalEntry->contact_person = $data['contact_person'] ?? null;
        $legalEntry->phone = $data['phone'] ?? null;
        $legalEntry->activity = $data['activity'] ?? null;
        $legalEntry->landline_phone = $data['landline_phone'] ?? null;
        $legalEntry->net_profit_type = $data['net_profit_type'] ?? IncomingEnum::INCOMING_FIRST_TYPE;
        $legalEntry->carrying_amount = $data['carrying_amount'] ?? null;
        $legalEntry->carrying_date = $data['carrying_date'] ?? null;
        $legalEntry->carrying_type = $data['carrying_type'] ?? IncomingEnum::INCOMING_FIRST_TYPE;
        $legalEntry->payables = $data['payables'] ?? null;
        $legalEntry->payables_date = $data['payables_date'] ?? null;
        $legalEntry->payables_type = $data['payables_type'] ?? IncomingEnum::INCOMING_FIRST_TYPE;
        $legalEntry->receivables = $data['receivables'] ?? null;
        $legalEntry->receivables_date = $data['receivables_date'] ?? null;
        $legalEntry->receivables_type = $data['receivables_type'] ??IncomingEnum::INCOMING_FIRST_TYPE;

        $legalEntry->save();

        return $legalEntry;
    }
}
