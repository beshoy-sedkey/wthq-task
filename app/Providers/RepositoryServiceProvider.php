<?php

namespace App\Providers;

use App\Repository\Contract\ProductRepositoryInterface;
use App\Repository\Contract\UserRepositoryInterface;
use App\Repository\Eloquent\ProductRepository;
use App\Repository\Eloquent\UserRepository as EloquentUserRepository;
use Illuminate\Support\ServiceProvider;
use UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class , EloquentUserRepository::class);
        $this->app->bind(ProductRepositoryInterface::class , ProductRepository::class);

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
