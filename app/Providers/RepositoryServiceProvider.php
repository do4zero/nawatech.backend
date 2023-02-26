<?php

namespace App\Providers;

use App\Interfaces\Products\ProductRepositoryInterface;
use App\Interfaces\Shop\ShopInformationRepositoryInterface;
use App\Interfaces\ShoppingSession\ShoppingSessionRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\ShopInformationRepository;
use App\Repositories\ShoppingSessionRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ShoppingSessionRepositoryInterface::class, ShoppingSessionRepository::class);
        $this->app->bind(ShopInformationRepositoryInterface::class, ShopInformationRepository::class);
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
