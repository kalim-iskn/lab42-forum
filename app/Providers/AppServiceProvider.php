<?php

namespace App\Providers;

use App\Services\Contracts\FileService;
use App\Services\Contracts\UserService;
use App\Services\EloquentUserService;
use App\Services\FileServiceImpl;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserService::class, EloquentUserService::class);
        $this->app->bind(FileService::class, FileServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
