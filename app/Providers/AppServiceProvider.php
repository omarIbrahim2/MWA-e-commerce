<?php

namespace App\Providers;

use Core\Interfaces\FileServiceInterface;
use Core\Repositories\CatRepo;
use Core\Services\FileService;
use Illuminate\Support\ServiceProvider;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
      
        app()->bind(FileServiceInterface::class, FileService::class);
       
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
