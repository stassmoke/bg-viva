<?php

namespace App\Repository;

use App\DTO\FilterDTO;
use App\DTO\SortByDTO;
use App\Models\Call;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class CallRepository implements CallRepositoryInterface
{
    /**
     * @inheritdoc
     * @return Call|null|object
     */
    public function find(int $id): ?Call
    {
        return Call::query()->find($id);
    }

    /**
     * @inheritdoc
     */
    public function findByUserAndPaginate(User $user, FilterDTO $filterDTO, SortByDTO $sortByDTO): LengthAwarePaginator
    {
        $callQuery = Call::query()
            ->where('user_id', '=', $user->id)
            ->orderBy($sortByDTO->getOrderBy(), $sortByDTO->getDirection())
        ;

        if ($filterDTO->getTerm() !== null) {
            $term = $filterDTO->getTerm();

            $callQuery
                ->where(function (Builder $builder) use ($term) {
                    return $builder
                        ->where('contact_name','LIKE','%' . $term .'%')
                        ->orWhere('ipn','LIKE','%' . $term .'%')
                        ->orWhere('edrpou_code','LIKE','%' . $term .'%')
                    ;
                })
            ;
        }

        return $callQuery
            ->paginate($filterDTO->getPerPage(), ['*'], 'page', $filterDTO->getPage())
        ;
    }

    /**
     * @inheritdoc
     */
    public function create(array $data): Call
    {
        $call = new Call();

        $call->user_id = $data['user_id'];

        return $this->update($data, $call);
    }

    /**
     * @inheritdoc
     */
    public function update(array $data, Call $call): Call
    {
        $call->type = $data['type'];
        $call->branch_code = $data['branch_code'];
        $call->name = $data['name'];
        $call->edrpou_code = $data['edrpou_code'];
        $call->contact_name = $data['contact_name'];
        $call->contact_position = $data['contact_position'];
        $call->phone = $data['phone'];
        $call->alternate_phone = $data['alternate_phone'];
        $call->ipn = $data['ipn'];
        $call->date_at = $data['date_at'];
        $call->comment = $data['comment'];

        $call->save();

        return $call;
    }
}
