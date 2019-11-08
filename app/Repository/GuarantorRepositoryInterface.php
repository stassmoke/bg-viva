<?php

namespace App\Repository;

use App\Models\Guarantor;

interface GuarantorRepositoryInterface
{
    /**
     * @param array $data
     * @return Guarantor
     */
    public function create(array $data): Guarantor;

    /**
     * @param array $data
     * @param Guarantor $guarantor
     * @return Guarantor
     */
    public function update(array $data, Guarantor $guarantor): Guarantor;
}
