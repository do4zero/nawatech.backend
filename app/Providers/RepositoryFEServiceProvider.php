<?php

namespace App\Providers;

use App\Interfaces\Payment\API\FEPaymentMethodInterface;
use App\Interfaces\Transaction\API\FETransactionRepositoryInterface;
use App\Interfaces\Products\API\FEShopRepositoryInterface;
use App\Interfaces\Products\FEProductRepositoryInterface;
use App\Repositories\API\FEPaymentMethodRepository;
use App\Repositories\API\FEProductRepository;
use App\Repositories\API\FEShopRepository;
use App\Repositories\API\FETransactionRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryFEServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(FEShopRepositoryInterface::class, FEShopRepository::class);
        $this->app->bind(FEProductRepositoryInterface::class, FEProductRepository::class);
        $this->app->bind(FEPaymentMethodInterface::class, FEPaymentMethodRepository::class);
        $this->app->bind(FETransactionRepositoryInterface::class, FETransactionRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
