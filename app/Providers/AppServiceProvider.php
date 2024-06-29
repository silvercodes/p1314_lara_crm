<?php

namespace App\Providers;

use App\Services\File\AbstractFileService;
use App\Services\File\DefaultFileService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AbstractFileService::class, function() {
            return new DefaultFileService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
