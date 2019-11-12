<?php

namespace App\Repository;

use App\DTO\FilterDTO;
use App\DTO\SortByDTO;
use App\Models\Meeting;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class MeetingRepository implements MeetingRepositoryInterface
{
    /**
     * @inheritdoc
     * @return Meeting|null|object
     */
    public function find(int $id): ?Meeting
    {
        return Meeting::query()->find($id);
    }

    /**
     * @inheritdoc
     */
    public function findByUserAndPaginate(User $user, FilterDTO $filterDTO, SortByDTO $sortByDTO): LengthAwarePaginator
    {
        $meetingQuery = Meeting::query()
            ->where('user_id', '=', $user->id)
            ->orderBy($sortByDTO->getOrderBy(), $sortByDTO->getDirection())
        ;

        if ($filterDTO->getTerm() !== null) {
            $term = $filterDTO->getTerm();

            $meetingQuery
                ->where(function (Builder $builder) use ($term) {
                    return $builder
                        ->where('contact_name','LIKE','%' . $term .'%')
                        ->orWhere('ipn','LIKE','%' . $term .'%')
                        ->orWhere('edrpou_code','LIKE','%' . $term .'%')
                        ;
                })
            ;
        }

        return $meetingQuery
            ->paginate($filterDTO->getPerPage(), ['*'], 'page', $filterDTO->getPage())
        ;
    }

    /**
     * @inheritdoc
     */
    public function create(array $data): Meeting
    {
        $meeting = new Meeting();

        $meeting->user_id = $data['user_id'];

        return $this->update($data, $meeting);
    }

    /**
     * @inheritdoc
     */
    public function update(array $data, Meeting $meeting): Meeting
    {
        $meeting->type = $data['type'];
        $meeting->name = $data['name'];
        $meeting->branch_code = $data['branch_code'];
        $meeting->edrpou_code = $data['edrpou_code'];
        $meeting->ipn = $data['ipn'];
        $meeting->contact_name = $data['contact_name'];
        $meeting->contact_position = $data['contact_position'];
        $meeting->phone = $data['phone'];
        $meeting->alternate_phone = $data['alternate_phone'];
        $meeting->date_at = $data['date_at'];
        $meeting->time_at = $data['time_at'];
        $meeting->comment = $data['comment'];
        $meeting->result = $data['result'];

        $meeting->save();

        return $meeting;
    }
}
