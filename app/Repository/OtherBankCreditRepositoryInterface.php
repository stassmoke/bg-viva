<?php

namespace App\Repository;

use App\Models\OtherBankCredit;

interface OtherBankCreditRepositoryInterface
{
    /**
     * @param array $data
     * @return OtherBankCredit
     */
    public function create(array $data): OtherBankCredit;

    /**
     * @param array $data
     * @param OtherBankCredit $bankCredit
     * @return OtherBankCredit
     */
    public function update(array $data, OtherBankCredit $bankCredit): OtherBankCredit;
}
