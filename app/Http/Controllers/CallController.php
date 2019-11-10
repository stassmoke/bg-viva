<?php

namespace App\Http\Controllers;

use App\Repository\CallRepositoryInterface;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
}
