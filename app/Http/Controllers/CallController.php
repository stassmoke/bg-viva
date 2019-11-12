<?php

namespace App\Http\Controllers;

use App\DTO\FilterDTO;
use App\DTO\SortByDTO;
use App\Repository\CallRepositoryInterface;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;

class CallController
{
    /**
     * @var CallRepositoryInterface
     */
    private $callRepository;

    /**
     * CallController constructor.
     * @param CallRepositoryInterface $callRepository
     */
    public function __construct(CallRepositoryInterface $callRepository)
    {
        $this->callRepository = $callRepository;
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

        $calls = $this->callRepository->findByUserAndPaginate($user, $filterDTO, $sortByDTO);

        return new JsonResponse($calls->toArray());
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function find(int $id, Request $request): Response
    {
        $call = $this->callRepository->find($id);

        if ($call === null) {
            return new JsonResponse([
                'call' => null,
            ], Response::HTTP_NOT_FOUND);
        }

        /** @var User $user */
        $user = $request->user();

        if ($call->user_id !== $user->id) {
            return new JsonResponse([
                'call' => null,
            ], Response::HTTP_FORBIDDEN);
        }

        return new JsonResponse([
            'call' => $call,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $callFormData = $request->request->get('call');

        /** @var User $user */
        $user = $request->user();

        $call = $this->callRepository->create([
            'type' => Arr::get($callFormData,'type'),
            'branch_code' => Arr::get($callFormData,'branch_code'),
            'name' => Arr::get($callFormData,'name'),
            'edrpou_code' => Arr::get($callFormData,'edrpou_code'),
            'ipn' => Arr::get($callFormData,'ipn'),
            'contact_name' => Arr::get($callFormData,'contact_name'),
            'contact_position' => Arr::get($callFormData,'contact_position'),
            'phone' => Arr::get($callFormData,'phone'),
            'alternate_phone' => Arr::get($callFormData,'alternate_phone'),
            'date_at' => Arr::get($callFormData,'date_at'),
            'comment' => Arr::get($callFormData,'comment'),
            'user_id' => $user->id,
        ]);

        return new JsonResponse($call);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function update(int $id, Request $request): Response
    {
        $call = $this->callRepository->find($id);

        if ($call === null) {
            return new JsonResponse([
                'status' => false,
            ], Response::HTTP_NOT_FOUND);
        }

        /** @var User $user */
        $user = $request->user();

        if ($call->user_id !== $user->id) {
            return new JsonResponse([
                'status' => false,
            ], Response::HTTP_FORBIDDEN);
        }

        $callFormData = $request->request->get('call');

        $this->callRepository->update([
            'type' => Arr::get($callFormData,'type'),
            'branch_code' => Arr::get($callFormData,'branch_code'),
            'name' => Arr::get($callFormData,'name'),
            'edrpou_code' => Arr::get($callFormData,'edrpou_code'),
            'ipn' => Arr::get($callFormData,'ipn'),
            'contact_name' => Arr::get($callFormData,'contact_name'),
            'contact_position' => Arr::get($callFormData,'contact_position'),
            'phone' => Arr::get($callFormData,'phone'),
            'alternate_phone' => Arr::get($callFormData,'alternate_phone'),
            'date_at' => Arr::get($callFormData,'date_at'),
            'comment' => Arr::get($callFormData,'comment'),
            'user_id' => $user->id,
        ], $call);


        return new JsonResponse($call);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function delete(int $id, Request $request): Response
    {
        $call = $this->callRepository->find($id);

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
