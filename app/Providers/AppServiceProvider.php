<?php

namespace App\Providers;

use App\Services\Contracts\FileService;
use App\Services\Contracts\SectionService;
use App\Services\Contracts\ThreadService;
use App\Services\Contracts\UserService;
use App\Services\EloquentSectionService;
use App\Services\EloquentThreadService;
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
        $this->app->bind(SectionService::class, EloquentSectionService::class);
        $this->app->bind(ThreadService::class, EloquentThreadService::class);
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
