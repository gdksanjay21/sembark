<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
                \App\Repositories\SuperAdmin\SuperAdminRepositoryInterface::class,
                \App\Repositories\SuperAdmin\SuperAdminRepository::class,
        );
        
        $this->app->bind(
                \App\Repositories\Admin\AdminRepositoryInterface::class,
                \App\Repositories\Admin\AdminRepository::class,
        );
        
        $this->app->bind(
                \App\Repositories\Member\MemberRepositoryInterface::class,
                \App\Repositories\Member\MemberRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
