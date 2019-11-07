<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            \App\Repository\UserRepositoryInterface::class,
            \App\Repository\UserRepository::class
        );

        $this->app->bind(
            \App\Repository\ClientRepositoryInterface::class,
            \App\Repository\ClientRepository::class
        );

        $this->app->bind(
            \App\Repository\IndividualRepositoryInterface::class,
            \App\Repository\IndividualRepository::class
        );

        $this->app->bind(
            \App\Repository\GuarantorRepositoryInterface::class,
            \App\Repository\GuarantorRepository::class
        );

        $this->app->bind(
            \App\Repository\RealEstateRepositoryInterface::class,
            \App\Repository\RealEstateRepository::class
        );

        $this->app->bind(
            \App\Repository\MovablesRepositoryInterface::class,
            \App\Repository\MovablesRepository::class
        );

        $this->app->bind(
            \App\Repository\LegalEntryRepositoryInterface::class,
            \App\Repository\LegalEntryRepository::class
        );

        $this->app->bind(
            \App\Repository\OtherBankCreditRepositoryInterface::class,
            \App\Repository\OtherBankCreditRepository::class
        );
    }
}
