<?php

namespace App\Repository;

use App\Models\Client;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ClientRepository implements ClientRepositoryInterface
{
    /**
     * @inheritdoc
     * @return Client|null|object
     */
    public function find(int $id): ?Client
    {
        return Client::query()->find($id);
    }

    /**
     * @inheritdoc
     */
    public function findByUserAndPaginate(User $user, int $page, int $perPage = 20): LengthAwarePaginator
    {
        return Client::query()
            ->where('user_id', '=', $user->id)
            ->with([
                'individual.guarantor',
                'individual.realEstates',
                'individual.movables',
                'legalEntry.equipment',
                'otherBankCredits',
            ])
            ->paginate($perPage, ['*'],'page', $page)
        ;
    }

    /**
     * @inheritdoc
     */
    public function create(array $data): Client
    {
        $client = new Client();

        $client->user_id = $data['user_id'];

        return $this->update($data, $client);
    }

    /**
     * @inheritdoc
     */
    public function update(array $data, Client $client): Client
    {
        $client->type = $data['type'];
        $client->legal_entity_id = $data['legal_entity_id'] ?? null;
        $client->individual_id = $data['individual_id'] ?? null;
        $client->branch_code = $data['branch_code'];
        $client->credit_meta = $data['credit_meta'] ?? null;
        $client->is_contract_concluded = $data['is_contract_concluded'] ?? null;
        $client->contract_number = $data['contract_number'] ?? null;
        $client->contract_date = $data['contract_date'] ?? null;
        $client->contract_sum = $data['contract_sum'] ?? null;
        $client->contract_percent = $data['contract_percent'] ?? null;

        $client->save();

        return $client;
    }
}
