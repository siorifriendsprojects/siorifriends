<?php

namespace App\Providers;

use App\SioriFriends\Models\User\UserRepository;
use App\SioriFriends\Repository\EloquentUserRepository;
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
