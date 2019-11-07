<?php

namespace App\Repository;

use App\Models\OtherBankCredit;

class OtherBankCreditRepository implements OtherBankCreditRepositoryInterface
{
    /**
     * @param array $data
     * @return OtherBankCredit
     */
    public function create(array $data): OtherBankCredit
    {
        $otherBankCredit = new OtherBankCredit();

        $otherBankCredit->name = $data['name'];
        $otherBankCredit->sum = $data['sum'];
        $otherBankCredit->date = $data['date'];
        $otherBankCredit->client_id = $data['client_id'];

        $otherBankCredit->save();

        return $otherBankCredit;
    }
}
