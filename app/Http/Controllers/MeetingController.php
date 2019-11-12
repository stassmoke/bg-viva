<?php

namespace App\Http\Controllers;

use App\DTO\FilterDTO;
use App\DTO\SortByDTO;
use App\Repository\MeetingRepositoryInterface;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;

class MeetingController
{
    /**
     * @var MeetingRepositoryInterface
     */
    private $meetingRepository;

    /**
     * MeetingController constructor.
     * @param MeetingRepositoryInterface $meetingRepository
     */
    public function __construct(MeetingRepositoryInterface $meetingRepository)
    {
        $this->meetingRepository = $meetingRepository;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function getList(Request $request): Response
    {
        /** @var User $user */
        $user = $request->user();

        $page = $request->query->getInt('page',1);
        $perPage = $request->query->getInt('perPage',15);
        $orderBy = $request->query->get('orderBy','id');
        $sortDirection = $request->query->get('sortDirection','desc');
        $term = $request->query->get('term');

        $filterDTO = new FilterDTO($page, $perPage);

        $filterDTO->setTerm($term);

        $sortByDTO = new SortByDTO($orderBy, $sortDirection);

        $calls = $this->meetingRepository->findByUserAndPaginate($user, $filterDTO, $sortByDTO);

        return new JsonResponse($calls->toArray());
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function find(int $id, Request $request): Response
    {
        $meeting = $this->meetingRepository->find($id);

        if ($meeting === null) {
            return new JsonResponse([
                'call' => null,
            ], Response::HTTP_NOT_FOUND);
        }

        /** @var User $user */
        $user = $request->user();

        if ($meeting->user_id !== $user->id) {
            return new JsonResponse([
                'call' => null,
            ], Response::HTTP_FORBIDDEN);
        }

        return new JsonResponse([
            'meeting' => $meeting,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $meetingFormData = $request->request->get('meeting');

        /** @var User $user */
        $user = $request->user();

        $meeting = $this->meetingRepository->create([
            'type' => Arr::get($meetingFormData,'type'),
            'name' => Arr::get($meetingFormData,'name'),
            'branch_code' => Arr::get($meetingFormData,'branch_code'),
            'edrpou_code' => Arr::get($meetingFormData,'edrpou_code'),
            'ipn' => Arr::get($meetingFormData,'ipn'),
            'contact_name' => Arr::get($meetingFormData,'contact_name'),
            'contact_position' => Arr::get($meetingFormData,'contact_position'),
            'phone' => Arr::get($meetingFormData,'phone'),
            'alternate_phone' => Arr::get($meetingFormData,'alternate_phone'),
            'date_at' => Arr::get($meetingFormData,'date_at'),
            'time_at' => Arr::get($meetingFormData,'time_at'),
            'comment' => Arr::get($meetingFormData,'comment'),
            'result' => Arr::get($meetingFormData,'result'),
            'user_id' => $user->id,
        ]);

        return new JsonResponse($meeting);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function update(int $id, Request $request): Response
    {
        $meeting = $this->meetingRepository->find($id);

        if ($meeting === null) {
            return new JsonResponse([
                'status' => false,
            ], Response::HTTP_NOT_FOUND);
        }

        /** @var User $user */
        $user = $request->user();

        if ($meeting->user_id !== $user->id) {
            return new JsonResponse([
                'status' => false,
            ], Response::HTTP_FORBIDDEN);
        }

        $meetingFormData = $request->request->get('call');

        $this->meetingRepository->update([
            'type' => Arr::get($meetingFormData,'type'),
            'name' => Arr::get($meetingFormData,'name'),
            'branch_code' => Arr::get($meetingFormData,'branch_code'),
            'edrpou_code' => Arr::get($meetingFormData,'edrpou_code'),
            'ipn' => Arr::get($meetingFormData,'ipn'),
            'contact_name' => Arr::get($meetingFormData,'contact_name'),
            'contact_position' => Arr::get($meetingFormData,'contact_position'),
            'phone' => Arr::get($meetingFormData,'phone'),
            'alternate_phone' => Arr::get($meetingFormData,'alternate_phone'),
            'date_at' => Arr::get($meetingFormData,'date_at'),
            'time_at' => Arr::get($meetingFormData,'time_at'),
            'comment' => Arr::get($meetingFormData,'comment'),
            'result' => Arr::get($meetingFormData,'result'),
        ], $meeting);


        return new JsonResponse($meeting);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function delete(int $id, Request $request): Response
    {
        $call = $this->meetingRepository->find($id);

        if ($call === null) {
            return new JsonResponse([
                'status' => true,
            ], Response::HTTP_OK);
        }

        /** @var User $user */
        $user = $request->user();

        if ($call->user_id !== $user->id) {
            return new JsonResponse([
                'status' => false,
            ], Response::HTTP_FORBIDDEN);
        }

        $call->delete();

        return new JsonResponse([
            'status' => true,
        ], Response::HTTP_OK);
    }
}
