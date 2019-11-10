<?php

namespace App\Repository;

use App\DTO\FilterDTO;
use App\DTO\SortByDTO;
use App\Models\Client;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

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
    public function findByUserAndPaginate(User $user, FilterDTO $filterDTO, SortByDTO $sortByDTO): LengthAwarePaginator
    {
        $clientQuery = Client::query()
            ->select(['clients.*'])
            ->where('user_id', '=', $user->id)
            ->with([
                'individual.guarantor',
                'individual.realEstates',
                'individual.movables',
                'legalEntry.equipment',
                'legalEntry.activities',
                'otherBankCredits',
            ])
            ->leftJoin('individuals as i','i.id','=','clients.individual_id')
            ->leftJoin('legal_entries as l','l.id','=','clients.legal_entity_id')
        ;

        if ($sortByDTO->getOrderBy() === 'code') {
            $clientQuery->orderByRaw('IF(clients.type = 3, i.ipn, l.edrpou_code) ' . $sortByDTO->getDirection());
        } else if ($sortByDTO->getOrderBy() === 'name') {
            $clientQuery->orderByRaw('IF(clients.type = 3, i.fio, l.name) ' . $sortByDTO->getDirection());
        } else {
            $clientQuery->orderBy($sortByDTO->getOrderBy(), $sortByDTO->getDirection());
        }

        if ($filterDTO->getTerm() !== null) {
            $term = $filterDTO->getTerm();

            $clientQuery
                ->where(function (Builder $builder) use ($term) {
                    return $builder
                        ->where('i.fio','LIKE','%' . $term .'%')
                        ->orWhere('l.name','LIKE','%' . $term .'%')
                        ->orWhere('l.edrpou_code','LIKE','%' . $term .'%')
                    ;
                })
            ;
        }

        return $clientQuery
            ->paginate($filterDTO->getPerPage(), ['*'], 'page', $filterDTO->getPage())
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
