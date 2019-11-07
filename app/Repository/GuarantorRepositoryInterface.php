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
}
