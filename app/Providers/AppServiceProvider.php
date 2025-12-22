<?php

namespace App\Providers;

use App\Domain\Repositories\CategoryRepositoryInterface;
use App\Domain\Repositories\ProductRepositoryInterface;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Infrastructure\Persistence\EloquentCategoryRepository;
use App\Infrastructure\Persistence\EloquentProductRepository;
use App\Infrastructure\Persistence\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            EloquentUserRepository::class
        );

        $this->app->bind(
            \App\Domain\Repositories\PasswordResetTokenRepositoryInterface::class,
            \App\Infrastructure\Persistence\EloquentPasswordResetTokenRepository::class
        );

        $this->app->bind(
            \App\Domain\Repositories\RoleRepositoryInterface::class,
            \App\Infrastructure\Persistence\EloquentRoleRepository::class
        );

        $this->app->bind(
            \App\Domain\Repositories\PermissionRepositoryInterface::class,
            \App\Infrastructure\Persistence\EloquentPermissionRepository::class
        );

        $this->app->bind(
            ProductRepositoryInterface::class,
            EloquentProductRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            EloquentCategoryRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
