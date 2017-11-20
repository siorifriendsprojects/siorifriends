<?php

namespace App\Providers;

use App\SioriFriends\Models\Book\BookRepository;
use App\SioriFriends\Models\User\UserRepository;
use App\SioriFriends\Repositories\EloquentBookRepository;
use App\SioriFriends\Repositories\EloquentUserRepository;
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

        $this->app->singleton(BookRepository::class, function($app) {
            return new EloquentBookRepository($app->make(UserRepository::class));
        });
    }
}
