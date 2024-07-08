<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use App\Services\File\AbstractFileService;
use App\Services\File\DefaultFileService;
use App\Services\Zip\ZipService;
use Illuminate\Support\Facades\Gate;
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

        $this->app->singleton(ZipService::class, function () {
            return new ZipService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Permission::get()->map(function(Permission $permission) {
            Gate::define($permission->slug, function(User $user) use($permission) {
                return $user->hasPermissionComplete($permission);
            });
        });
    }
}
