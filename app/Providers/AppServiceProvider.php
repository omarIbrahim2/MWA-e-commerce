<?php

namespace App\Providers;

use Core\Repositories\CatRepo;
use Core\Services\FileService;
use Illuminate\Support\ServiceProvider;
use core\Interfaces\FileServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind(FileServiceInterface::class , FileService::class);
        app()->bind(CatRepo::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
