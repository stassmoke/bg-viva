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
}
