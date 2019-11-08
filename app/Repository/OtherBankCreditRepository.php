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
        $bankCredit = new OtherBankCredit();

        $bankCredit->client_id = $data['client_id'];

        return $this->update($data, $bankCredit);
    }

    /**
     * @inheritdoc
     */
    public function update(array $data, OtherBankCredit $bankCredit): OtherBankCredit
    {
        $bankCredit->name = $data['name'];
        $bankCredit->sum = $data['sum'];
        $bankCredit->date = $data['date'];

        $bankCredit->save();

        return $bankCredit;
    }
}
