<?php

namespace App\Repository;

use App\Models\Client;
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

    /**
     * @param iterable $ids
     * @param Client $client
     */
    public function removeWhereNotIdByClient(iterable $ids, Client $client): void;
}
