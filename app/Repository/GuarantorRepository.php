<?php

namespace App\Repository;

use App\Models\Guarantor;

class GuarantorRepository implements GuarantorRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function create(array $data): Guarantor
    {
        $guarantor = new Guarantor();

        return $this->update($data, $guarantor);
    }

    /**
     * @inheritdoc
     */
    public function update(array $data, Guarantor $guarantor): Guarantor
    {
        $guarantor->fio = $data['fio'] ?? null;
        $guarantor->ipn = $data['ipn'] ?? null;
        $guarantor->registration_address = $data['registration_address'] ?? null;
        $guarantor->residence_address = $data['residence_address'] ?? null;

        $guarantor->save();

        return $guarantor;
    }

}
