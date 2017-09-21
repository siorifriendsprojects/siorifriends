<?php

namespace App\Providers;

use App\Siorifriends\Models\User\UserRepository;
use App\Siorifriends\Repository\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepository::class, function($app) {
            return new EloquentUserRepository();
        });
    }
}
