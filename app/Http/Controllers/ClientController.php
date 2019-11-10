<?php

namespace App\Http\Controllers;

use App\DTO\FilterDTO;
use App\DTO\SortByDTO;
use App\Repository\ClientRepositoryInterface;
use App\Repository\EquipmentRepositoryInterface;
use App\Repository\GuarantorRepositoryInterface;
use App\Repository\IndividualRepositoryInterface;
use App\Repository\LegalEntryRepositoryInterface;
use App\Repository\MovablesRepositoryInterface;
use App\Repository\OtherBankCreditRepositoryInterface;
use App\Repository\RealEstateRepositoryInterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{
    /**
     * @var ClientRepositoryInterface
     */
    private $clientRepository;

    /**
     * @var GuarantorRepositoryInterface
     */
    private $guarantorRepository;

    /**
     * @var IndividualRepositoryInterface
     */
    private $individualRepository;

    /**
     * @var LegalEntryRepositoryInterface
     */
    private $legalEntryRepository;

    /**
     * @var MovablesRepositoryInterface
     */
    private $movablesRepository;

    /**
     * @var OtherBankCreditRepositoryInterface
     */
    private $otherBankCreditRepository;

    /**
     * @var RealEstateRepositoryInterface
     */
    private $realEstateRepository;

    /**
     * @var EquipmentRepositoryInterface
     */
    private $equipmentRepository;

    /**
     * ClientController constructor.
     * @param ClientRepositoryInterface $clientRepository
     * @param GuarantorRepositoryInterface $guarantorRepository
     * @param IndividualRepositoryInterface $individualRepository
     * @param LegalEntryRepositoryInterface $legalEntryRepository
     * @param MovablesRepositoryInterface $movablesRepository
     * @param OtherBankCreditRepositoryInterface $otherBankCreditRepository
     * @param RealEstateRepositoryInterface $realEstateRepository
     * @param EquipmentRepositoryInterface $equipmentRepository
     */
    public function __construct(
        ClientRepositoryInterface $clientRepository,
        GuarantorRepositoryInterface $guarantorRepository,
        IndividualRepositoryInterface $individualRepository,
        LegalEntryRepositoryInterface $legalEntryRepository,
        MovablesRepositoryInterface $movablesRepository,
        OtherBankCreditRepositoryInterface $otherBankCreditRepository,
        RealEstateRepositoryInterface $realEstateRepository,
        EquipmentRepositoryInterface $equipmentRepository
    )
    {
        $this->clientRepository = $clientRepository;
        $this->guarantorRepository = $guarantorRepository;
        $this->individualRepository = $individualRepository;
        $this->legalEntryRepository = $legalEntryRepository;
        $this->movablesRepository = $movablesRepository;
        $this->otherBankCreditRepository = $otherBankCreditRepository;
        $this->realEstateRepository = $realEstateRepository;
        $this->equipmentRepository = $equipmentRepository;
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
        $orderBy = $request->query->get('orderBy','clients.id');
        $sortDirection = $request->query->get('sortDirection','desc');
        $term = $request->query->get('term');

        $filterDTO = new FilterDTO($page, $perPage);

        $filterDTO->setTerm($term);

        $sortByDTO = new SortByDTO($orderBy, $sortDirection);

        $clients = $this->clientRepository->findByUserAndPaginate($user, $filterDTO, $sortByDTO);

        return new JsonResponse($clients->toArray());
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function find(int $id, Request $request): Response
    {
        $client = $this->clientRepository->find($id);

        if ($client === null) {
            return new JsonResponse([
                'client' => null,
            ], Response::HTTP_NOT_FOUND);
        }

        /** @var User $user */
        $user = $request->user();

        if ($client->user_id !== $user->id) {
            return new JsonResponse([
                'client' => null,
            ], Response::HTTP_FORBIDDEN);
        }

        $client->load([
            'individual.guarantor',
            'individual.realEstates',
            'individual.movables',
            'legalEntry.equipment',
            'otherBankCredits',
        ]);

        return new JsonResponse([
            'client' => $client,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $clientFormData = $request->request->get('client');

        /** @var User $user */
        $user = $request->user();

        $clientData = [
            'user_id' => $user->id,
            'type' => Arr::get($clientFormData,'type'),
            'branch_code' => Arr::get($clientFormData,'branch_code'),
            'credit_meta' => Arr::get($clientFormData,'credit_meta'),
            'is_contract_concluded' => Arr::get($clientFormData,'is_contract_concluded'),
            'contract_number' => Arr::get($clientFormData,'contract_number'),
            'contract_date' => Arr::get($clientFormData,'contract_date'),
            'contract_sum' => Arr::get($clientFormData,'contract_sum'),
            'contract_percent' => Arr::get($clientFormData,'contract_percent'),
        ];

        $individualFormData = Arr::get($clientFormData,'individual');

        if (\is_array($individualFormData)) {
            $individualData = [
                'fio' => Arr::get($individualFormData,'fio'),
                'ipn' => Arr::get($individualFormData,'ipn'),
                'registration_address' => Arr::get($individualFormData,'registration_address'),
                'residence_address' => Arr::get($individualFormData,'residence_address'),
                'contact_phone' => Arr::get($individualFormData,'contact_phone'),
                'work_place' => Arr::get($individualFormData,'work_place'),
                'work_place_phone' => Arr::get($individualFormData,'work_place_phone'),
                'average_monthly_income' => Arr::get($individualFormData,'average_monthly_income'),
                'another_income' => Arr::get($individualFormData,'another_income'),
                'is_married' => Arr::get($individualFormData,'is_married'),
                'dependents_count' => Arr::get($individualFormData,'dependents_count'),
                'is_have_guarantor' => false,
            ];

            $guarantorData = Arr::get($individualFormData,'guarantor');

            if (\is_array($guarantorData)) {
                $guarantor = $this->guarantorRepository->create([
                    'fio' => Arr::get($guarantorData, 'fio'),
                    'ipn' => Arr::get($guarantorData, 'ipn'),
                    'registration_address' => Arr::get($guarantorData, 'registration_address'),
                    'residence_address' => Arr::get($guarantorData, 'residence_address'),
                ]);

                $individualData['guarantor_id'] = $guarantor->id;
                $individualData['is_have_guarantor'] = true;
            }

            $individual = $this->individualRepository->create($individualData);

            $clientData['individual_id'] = $individual->id;

            $realEstatesData = (array) Arr::get($individualFormData,'real_estates', []);

            foreach ($realEstatesData as $estatesDatum) {
                $this->realEstateRepository->create([
                    'description' => $estatesDatum['description'],
                    'individual_id' => $individual->id,
                ]);
            }

            $movablesData = (array) Arr::get($individualFormData,'movables', []);

            foreach ($movablesData as $movablesDatum) {
                $this->movablesRepository->create([
                    'description' => $movablesDatum['description'],
                    'individual_id' => $individual->id,
                ]);
            }
        }

        $legalEntryFromData = Arr::get($clientFormData,'legal_entry');

        if (\is_array($legalEntryFromData)) {
            $legalEntry = $this->legalEntryRepository->create([
                'name' => Arr::get($legalEntryFromData,'name'),
                'edrpou_code' => Arr::get($legalEntryFromData,'edrpou_code'),
                'legal_address' => Arr::get($legalEntryFromData,'legal_address'),
                'actual_address' => Arr::get($legalEntryFromData,'actual_address'),
                'contact_person' => Arr::get($legalEntryFromData,'contact_person'),
                'phone' => Arr::get($legalEntryFromData,'phone'),
                'landline_phone' => Arr::get($legalEntryFromData,'landline_phone'),
                'activity' => Arr::get($legalEntryFromData,'activity'),
                'net_profit_type' => Arr::get($legalEntryFromData,'net_profit_type'),
                'carrying_amount' => Arr::get($legalEntryFromData,'carrying_amount'),
                'carrying_date' => Arr::get($legalEntryFromData,'carrying_date'),
                'carrying_type' => Arr::get($legalEntryFromData,'carrying_type'),
                'payables' => Arr::get($legalEntryFromData,'payables'),
                'payables_date' => Arr::get($legalEntryFromData,'payables_date'),
                'payables_type' => Arr::get($legalEntryFromData,'payables_type'),
                'receivables' => Arr::get($legalEntryFromData,'receivables'),
                'receivables_date' => Arr::get($legalEntryFromData,'receivables_date'),
                'receivables_type' => Arr::get($legalEntryFromData,'receivables_type'),
            ]);

            $clientData['legal_entity_id'] = $legalEntry->id;

            $equipmentData = (array) Arr::get($legalEntryFromData,'equipment', []);

            foreach ($equipmentData as $equipmentDatum) {
                $this->equipmentRepository->create([
                    'legal_entity_id' => $legalEntry->id,
                    'description' => $equipmentDatum['description'],
                ]);
            }
        }

        $client = $this->clientRepository->create($clientData);

        $otherBankCredits = (array) Arr::get($clientFormData,'other_bank_credits', []);

        foreach ($otherBankCredits as $bankCredit) {
            $this->otherBankCreditRepository->create([
                'name' => Arr::get($bankCredit,'name'),
                'sum' => Arr::get($bankCredit,'sum'),
                'date' => Arr::get($bankCredit,'date'),
                'client_id' => $client->id,
            ]);
        }

        return new JsonResponse($client);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function update(int $id, Request $request): Response
    {
        $client = $this->clientRepository->find($id);

        if ($client === null) {
            return new JsonResponse([
                'status' => false,
            ], Response::HTTP_NOT_FOUND);
        }

        /** @var User $user */
        $user = $request->user();

        if ($client->user_id !== $user->id) {
            return new JsonResponse([
                'status' => false,
            ], Response::HTTP_FORBIDDEN);
        }

        $clientFormData = $request->request->get('client');

        $clientData = [
            'type' => Arr::get($clientFormData,'type'),
            'branch_code' => Arr::get($clientFormData,'branch_code'),
            'credit_meta' => Arr::get($clientFormData,'credit_meta'),
            'is_contract_concluded' => Arr::get($clientFormData,'is_contract_concluded'),
            'contract_number' => Arr::get($clientFormData,'contract_number'),
            'contract_date' => Arr::get($clientFormData,'contract_date'),
            'contract_sum' => Arr::get($clientFormData,'contract_sum'),
            'contract_percent' => Arr::get($clientFormData,'contract_percent'),
        ];

        $individualFormData = Arr::get($clientFormData,'individual');

        if (\is_array($individualFormData)) {
            $individualData = [
                'fio' => Arr::get($individualFormData,'fio'),
                'ipn' => Arr::get($individualFormData,'ipn'),
                'registration_address' => Arr::get($individualFormData,'registration_address'),
                'residence_address' => Arr::get($individualFormData,'residence_address'),
                'contact_phone' => Arr::get($individualFormData,'contact_phone'),
                'work_place' => Arr::get($individualFormData,'work_place'),
                'work_place_phone' => Arr::get($individualFormData,'work_place_phone'),
                'average_monthly_income' => Arr::get($individualFormData,'average_monthly_income'),
                'another_income' => Arr::get($individualFormData,'another_income'),
                'is_married' => Arr::get($individualFormData,'is_married'),
                'dependents_count' => Arr::get($individualFormData,'dependents_count'),
                'is_have_guarantor' => false,
            ];

            $guarantorFormData = Arr::get($individualFormData,'guarantor');

            if (\is_array($guarantorFormData)) {
                $guarantorData = [
                    'fio' => Arr::get($guarantorFormData, 'fio'),
                    'ipn' => Arr::get($guarantorFormData, 'ipn'),
                    'registration_address' => Arr::get($guarantorFormData, 'registration_address'),
                    'residence_address' => Arr::get($guarantorFormData, 'residence_address'),
                ];

                if ($client->individual->guarantor === null) {
                    $guarantor = $this->guarantorRepository->create($guarantorData);
                } else {
                    $guarantor = $this->guarantorRepository->update($guarantorData, $client->individual->guarantor);
                }

                $individualData['guarantor_id'] = $guarantor->id;
                $individualData['is_have_guarantor'] = true;
            } else {
                $individualData['is_have_guarantor'] = false;
            }

            if ($client->individual === null) {
                $individual = $this->individualRepository->create($individualData);
            } else {
                $individual = $this->individualRepository->update($individualData, $client->individual);
            }

            $clientData['individual_id'] = $individual->id;

            $realEstatesData = (array) Arr::get($individualFormData,'real_estates', []);

            $individualEstates = $individual->realEstates->keyBy('id');

            foreach ($realEstatesData as $estatesDatum) {
                $id = Arr::get($estatesDatum,'id');

                if ($individualEstates->has($id)) {
                    $this->realEstateRepository->update([
                        'description' => $estatesDatum['description'],
                    ], $individualEstates->get($id));
                } else {
                    $this->realEstateRepository->create([
                        'description' => $estatesDatum['description'],
                        'individual_id' => $individual->id,
                    ]);
                }
            }

            $movablesData = (array) Arr::get($individualFormData,'movables', []);

            $individualMovables = $individual->movables->keyBy('id');

            foreach ($movablesData as $movablesDatum) {
                $id = Arr::get($movablesDatum,'id');

                if ($individualMovables->has($id)) {
                    $this->movablesRepository->update([
                        'description' => $movablesDatum['description'],
                        'individual_id' => $individual->id,
                    ], $individualMovables->get($id));
                } else {
                    $this->movablesRepository->create([
                        'description' => $movablesDatum['description'],
                        'individual_id' => $individual->id,
                    ]);
                }
            }
        }

        $legalEntryFromData = Arr::get($clientFormData,'legal_entry');

        if (\is_array($legalEntryFromData)) {
            $legalEntryData = [
                'name' => Arr::get($legalEntryFromData,'name'),
                'edrpou_code' => Arr::get($legalEntryFromData,'edrpou_code'),
                'legal_address' => Arr::get($legalEntryFromData,'legal_address'),
                'actual_address' => Arr::get($legalEntryFromData,'actual_address'),
                'contact_person' => Arr::get($legalEntryFromData,'contact_person'),
                'phone' => Arr::get($legalEntryFromData,'phone'),
                'landline_phone' => Arr::get($legalEntryFromData,'landline_phone'),
                'activity' => Arr::get($legalEntryFromData,'activity'),
                'net_profit_type' => Arr::get($legalEntryFromData,'net_profit_type'),
                'carrying_amount' => Arr::get($legalEntryFromData,'carrying_amount'),
                'carrying_date' => Arr::get($legalEntryFromData,'carrying_date'),
                'carrying_type' => Arr::get($legalEntryFromData,'carrying_type'),
                'payables' => Arr::get($legalEntryFromData,'payables'),
                'payables_date' => Arr::get($legalEntryFromData,'payables_date'),
                'payables_type' => Arr::get($legalEntryFromData,'payables_type'),
                'receivables' => Arr::get($legalEntryFromData,'receivables'),
                'receivables_date' => Arr::get($legalEntryFromData,'receivables_date'),
                'receivables_type' => Arr::get($legalEntryFromData,'receivables_type'),
            ];

            if ($client->legalEntry === null) {
                $legalEntry = $this->legalEntryRepository->create($legalEntryData);
            } else {
                $legalEntry = $this->legalEntryRepository->update($legalEntryData, $client->legalEntry);
            }

            $clientData['legal_entity_id'] = $legalEntry->id;

            $equipmentData = (array) Arr::get($legalEntryFromData,'equipment', []);

            $legalEntryEquipment = $legalEntry->equipment->keyBy('id');

            foreach ($equipmentData as $equipmentDatum) {
                $id = Arr::get($equipmentDatum, 'id');

                if ($legalEntryEquipment->has($id)) {
                    $this->equipmentRepository->update([
                        'description' => $equipmentDatum['description'],
                    ], $legalEntryEquipment->get($id));
                } else {
                    $this->equipmentRepository->create([
                        'legal_entity_id' => $legalEntry->id,
                        'description' => $equipmentDatum['description'],
                    ]);
                }
            }
        }

        $client = $this->clientRepository->update($clientData, $client);

        $otherBankCredits = (array) Arr::get($clientFormData,'other_bank_credits', []);

        $clientOtherBankCredits = $client->otherBankCredits->keyBy('id');

        foreach ($otherBankCredits as $bankCredit) {
            $id = Arr::get($bankCredit, 'id');

            if ($clientOtherBankCredits->has($id)) {
                $this->otherBankCreditRepository->update([
                    'name' => Arr::get($bankCredit,'name'),
                    'sum' => Arr::get($bankCredit,'sum'),
                    'date' => Arr::get($bankCredit,'date'),
                ], $clientOtherBankCredits->get($id));
            } else {
                $this->otherBankCreditRepository->create([
                    'name' => Arr::get($bankCredit,'name'),
                    'sum' => Arr::get($bankCredit,'sum'),
                    'date' => Arr::get($bankCredit,'date'),
                    'client_id' => $client->id,
                ]);
            }
        }

        return new JsonResponse($client);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function delete(int $id, Request $request): Response
    {
        $client = $this->clientRepository->find($id);

        if ($client === null) {
            return new JsonResponse([
                'status' => true,
            ], Response::HTTP_OK);
        }

        /** @var User $user */
        $user = $request->user();

        if ($client->user_id !== $user->id) {
            return new JsonResponse([
                'status' => false,
            ], Response::HTTP_FORBIDDEN);
        }

        $client->delete();

        return new JsonResponse([
            'status' => true,
        ], Response::HTTP_OK);
    }
}
