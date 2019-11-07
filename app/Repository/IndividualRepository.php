<?php

namespace App\Repository;

use App\Models\Individual;

class IndividualRepository implements IndividualRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function create(array $data): Individual
    {
        $individual = new Individual();

        $individual->fio = $data['fio'] ?? null;
        $individual->ipn = $data['ipn'] ?? null;
        $individual->registration_address = $data['registration_address'] ?? null;
        $individual->guarantor_id = $data['guarantor_id'] ?? null;
        $individual->residence_address = $data['residence_address'] ?? null;
        $individual->contact_phone = $data['contact_phone'] ?? null;
        $individual->work_place = $data['work_place'] ?? null;
        $individual->work_place_phone = $data['work_place_phone'] ?? null;
        $individual->average_monthly_income = $data['average_monthly_income'] ?? null;
        $individual->another_income = $data['another_income'] ?? null;
        $individual->is_married = $data['is_married'] ?? false;
        $individual->dependents_count = $data['dependents_count'] ?? 0;
        $individual->is_have_guarantor = $data['is_have_guarantor'] ?? false;

        $individual->save();

        return $individual;
    }
}
